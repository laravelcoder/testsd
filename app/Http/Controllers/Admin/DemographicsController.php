<?php

namespace App\Http\Controllers\Admin;

use App\Demographic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDemographicsRequest;
use App\Http\Requests\Admin\UpdateDemographicsRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DemographicsController extends Controller
{
    /**
     * Display a listing of Demographic.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('demographic_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Demographic.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Demographic.filter', 'my');
            }
        }

        
        if (request()->ajax()) {
            $query = Demographic::query();
            $query->with("created_by");
            $query->with("created_by_team");
            $query->with("advertiser");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('demographic_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'demographics.id',
                'demographics.demographic',
                'demographics.value',
                'demographics.created_by_id',
                'demographics.created_by_team_id',
                'demographics.advertiser_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'demographic_';
                $routeKey = 'admin.demographics';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('demographic', function ($row) {
                return $row->demographic ? $row->demographic : '';
            });
            $table->editColumn('value', function ($row) {
                return $row->value ? $row->value : '';
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

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.demographics.index');
    }

    /**
     * Show the form for creating new Demographic.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('demographic_create')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $advertisers = \App\ContactCompany::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.demographics.create', compact('created_bies', 'created_by_teams', 'advertisers'));
    }

    /**
     * Store a newly created Demographic in storage.
     *
     * @param  \App\Http\Requests\StoreDemographicsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDemographicsRequest $request)
    {
        if (! Gate::allows('demographic_create')) {
            return abort(401);
        }
        $demographic = Demographic::create($request->all());



        return redirect()->route('admin.demographics.index');
    }


    /**
     * Show the form for editing Demographic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('demographic_edit')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $advertisers = \App\ContactCompany::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $demographic = Demographic::findOrFail($id);

        return view('admin.demographics.edit', compact('demographic', 'created_bies', 'created_by_teams', 'advertisers'));
    }

    /**
     * Update Demographic in storage.
     *
     * @param  \App\Http\Requests\UpdateDemographicsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDemographicsRequest $request, $id)
    {
        if (! Gate::allows('demographic_edit')) {
            return abort(401);
        }
        $demographic = Demographic::findOrFail($id);
        $demographic->update($request->all());



        return redirect()->route('admin.demographics.index');
    }


    /**
     * Display Demographic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('demographic_view')) {
            return abort(401);
        }
        $demographic = Demographic::findOrFail($id);

        return view('admin.demographics.show', compact('demographic'));
    }


    /**
     * Remove Demographic from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('demographic_delete')) {
            return abort(401);
        }
        $demographic = Demographic::findOrFail($id);
        $demographic->delete();

        return redirect()->route('admin.demographics.index');
    }

    /**
     * Delete all selected Demographic at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('demographic_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Demographic::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Demographic from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('demographic_delete')) {
            return abort(401);
        }
        $demographic = Demographic::onlyTrashed()->findOrFail($id);
        $demographic->restore();

        return redirect()->route('admin.demographics.index');
    }

    /**
     * Permanently delete Demographic from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('demographic_delete')) {
            return abort(401);
        }
        $demographic = Demographic::onlyTrashed()->findOrFail($id);
        $demographic->forceDelete();

        return redirect()->route('admin.demographics.index');
    }
}
