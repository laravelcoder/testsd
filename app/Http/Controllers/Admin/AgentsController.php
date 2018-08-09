<?php

namespace App\Http\Controllers\Admin;

use App\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAgentsRequest;
use App\Http\Requests\Admin\UpdateAgentsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class AgentsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Agent.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('agent_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Agent.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Agent.filter', 'my');
            }
        }

        
        if (request()->ajax()) {
            $query = Agent::query();
            $query->with("advertiser");
            $query->with("created_by");
            $query->with("created_by_team");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('agent_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'agents.id',
                'agents.advertiser_id',
                'agents.first_name',
                'agents.last_name',
                'agents.email',
                'agents.skype',
                'agents.address',
                'agents.photo',
                'agents.about',
                'agents.created_by_id',
                'agents.created_by_team_id',
                'agents.notes',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'agent_';
                $routeKey = 'admin.agents';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('advertiser.name', function ($row) {
                return $row->advertiser ? $row->advertiser->name : '';
            });
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('skype', function ($row) {
                return $row->skype ? $row->skype : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('photo', function ($row) {
                if($row->photo) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->photo) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->photo) .'"/>'; };
            });
            $table->editColumn('about', function ($row) {
                return $row->about ? $row->about : '';
            });
            $table->editColumn('created_by.name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });
            $table->editColumn('created_by_team.name', function ($row) {
                return $row->created_by_team ? $row->created_by_team->name : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });

            $table->rawColumns(['actions','massDelete','photo']);

            return $table->make(true);
        }

        return view('admin.agents.index');
    }

    /**
     * Show the form for creating new Agent.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('agent_create')) {
            return abort(401);
        }
        
        $advertisers = \App\ContactCompany::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.agents.create', compact('advertisers', 'created_bies', 'created_by_teams'));
    }

    /**
     * Store a newly created Agent in storage.
     *
     * @param  \App\Http\Requests\StoreAgentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgentsRequest $request)
    {
        if (! Gate::allows('agent_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $agent = Agent::create($request->all());

        foreach ($request->input('phones', []) as $data) {
            $agent->phones()->create($data);
        }


        return redirect()->route('admin.agents.index');
    }


    /**
     * Show the form for editing Agent.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('agent_edit')) {
            return abort(401);
        }
        
        $advertisers = \App\ContactCompany::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $agent = Agent::findOrFail($id);

        return view('admin.agents.edit', compact('agent', 'advertisers', 'created_bies', 'created_by_teams'));
    }

    /**
     * Update Agent in storage.
     *
     * @param  \App\Http\Requests\UpdateAgentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgentsRequest $request, $id)
    {
        if (! Gate::allows('agent_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $agent = Agent::findOrFail($id);
        $agent->update($request->all());

        $phones           = $agent->phones;
        $currentPhoneData = [];
        foreach ($request->input('phones', []) as $index => $data) {
            if (is_integer($index)) {
                $agent->phones()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentPhoneData[$id] = $data;
            }
        }
        foreach ($phones as $item) {
            if (isset($currentPhoneData[$item->id])) {
                $item->update($currentPhoneData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.agents.index');
    }


    /**
     * Display Agent.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('agent_view')) {
            return abort(401);
        }
        
        $advertisers = \App\ContactCompany::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$phones = \App\Phone::where('agent_id', $id)->get();

        $agent = Agent::findOrFail($id);

        return view('admin.agents.show', compact('agent', 'phones'));
    }


    /**
     * Remove Agent from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('agent_delete')) {
            return abort(401);
        }
        $agent = Agent::findOrFail($id);
        $agent->delete();

        return redirect()->route('admin.agents.index');
    }

    /**
     * Delete all selected Agent at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('agent_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Agent::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Agent from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('agent_delete')) {
            return abort(401);
        }
        $agent = Agent::onlyTrashed()->findOrFail($id);
        $agent->restore();

        return redirect()->route('admin.agents.index');
    }

    /**
     * Permanently delete Agent from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('agent_delete')) {
            return abort(401);
        }
        $agent = Agent::onlyTrashed()->findOrFail($id);
        $agent->forceDelete();

        return redirect()->route('admin.agents.index');
    }
}
