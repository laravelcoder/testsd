<?php

namespace App\Http\Controllers\Admin;

use App\Audience;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAudiencesRequest;
use App\Http\Requests\Admin\UpdateAudiencesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class AudiencesController extends Controller
{
    /**
     * Display a listing of Audience.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('audience_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Audience.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Audience.filter', 'my');
            }
        }

        if (request()->ajax()) {
            $query = Audience::query();
            $query->with('created_by');
            $query->with('created_by_team');
            $query->with('advertiser');
            $template = 'actionsTemplate';
            if (request('show_deleted') == 1) {
                if (!Gate::allows('audience_delete')) {
                    return abort(401);
                }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'audiences.id',
                'audiences.name',
                'audiences.value',
                'audiences.created_by_id',
                'audiences.created_by_team_id',
                'audiences.advertiser_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey = 'audience_';
                $routeKey = 'admin.audiences';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('created_by.name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });
            $table->editColumn('created_by_team.name', function ($row) {
                return $row->created_by_team ? $row->created_by_team->name : '';
            });
            $table->editColumn('advertiser.name', function ($row) {
                return $row->advertiser ? $row->advertiser->name : '';
            });

            $table->rawColumns(['actions', 'massDelete']);

            return $table->make(true);
        }

        return view('admin.audiences.index');
    }

    /**
     * Show the form for creating new Audience.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('audience_create')) {
            return abort(401);
        }

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $advertisers = \App\ContactCompany::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.audiences.create', compact('created_bies', 'created_by_teams', 'advertisers'));
    }

    /**
     * Store a newly created Audience in storage.
     *
     * @param \App\Http\Requests\StoreAudiencesRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAudiencesRequest $request)
    {
        if (!Gate::allows('audience_create')) {
            return abort(401);
        }
        $audience = Audience::create($request->all());

        return redirect()->route('admin.audiences.index');
    }

    /**
     * Show the form for editing Audience.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('audience_edit')) {
            return abort(401);
        }

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $advertisers = \App\ContactCompany::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $audience = Audience::findOrFail($id);

        return view('admin.audiences.edit', compact('audience', 'created_bies', 'created_by_teams', 'advertisers'));
    }

    /**
     * Update Audience in storage.
     *
     * @param \App\Http\Requests\UpdateAudiencesRequest $request
     * @param int                                       $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAudiencesRequest $request, $id)
    {
        if (!Gate::allows('audience_edit')) {
            return abort(401);
        }
        $audience = Audience::findOrFail($id);
        $audience->update($request->all());

        return redirect()->route('admin.audiences.index');
    }

    /**
     * Display Audience.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('audience_view')) {
            return abort(401);
        }
        $audience = Audience::findOrFail($id);

        return view('admin.audiences.show', compact('audience'));
    }

    /**
     * Remove Audience from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('audience_delete')) {
            return abort(401);
        }
        $audience = Audience::findOrFail($id);
        $audience->delete();

        return redirect()->route('admin.audiences.index');
    }

    /**
     * Delete all selected Audience at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('audience_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Audience::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    /**
     * Restore Audience from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('audience_delete')) {
            return abort(401);
        }
        $audience = Audience::onlyTrashed()->findOrFail($id);
        $audience->restore();

        return redirect()->route('admin.audiences.index');
    }

    /**
     * Permanently delete Audience from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (!Gate::allows('audience_delete')) {
            return abort(401);
        }
        $audience = Audience::onlyTrashed()->findOrFail($id);
        $audience->forceDelete();

        return redirect()->route('admin.audiences.index');
    }
}
