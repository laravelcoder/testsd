<?php

namespace App\Http\Controllers\Admin;

use App\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCampaignsRequest;
use App\Http\Requests\Admin\UpdateCampaignsRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CampaignsController extends Controller
{
    /**
     * Display a listing of Campaign.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('campaign_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Campaign.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Campaign.filter', 'my');
            }
        }

        
        if (request()->ajax()) {
            $query = Campaign::query();
            $query->with("created_by");
            $query->with("created_by_team");
            $query->with("advertiser");
            $query->with("ads");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('campaign_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'campaigns.id',
                'campaigns.name',
                'campaigns.start_date',
                'campaigns.finish_date',
                'campaigns.created_by_id',
                'campaigns.created_by_team_id',
                'campaigns.advertiser_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'campaign_';
                $routeKey = 'admin.campaigns';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('start_date', function ($row) {
                return $row->start_date ? $row->start_date : '';
            });
            $table->editColumn('finish_date', function ($row) {
                return $row->finish_date ? $row->finish_date : '';
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
            $table->editColumn('ads.ad_label', function ($row) {
                if(count($row->ads) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->ads->pluck('ad_label')->toArray()) . '</span>';
            });

            $table->rawColumns(['actions','massDelete','ads.ad_label']);

            return $table->make(true);
        }

        return view('admin.campaigns.index');
    }

    /**
     * Show the form for creating new Campaign.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('campaign_create')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $advertisers = \App\ContactCompany::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $ads = \App\Ad::get()->pluck('ad_label', 'id');


        return view('admin.campaigns.create', compact('created_bies', 'created_by_teams', 'advertisers', 'ads'));
    }

    /**
     * Store a newly created Campaign in storage.
     *
     * @param  \App\Http\Requests\StoreCampaignsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCampaignsRequest $request)
    {
        if (! Gate::allows('campaign_create')) {
            return abort(401);
        }
        $campaign = Campaign::create($request->all());
        $campaign->ads()->sync(array_filter((array)$request->input('ads')));



        return redirect()->route('admin.campaigns.index');
    }


    /**
     * Show the form for editing Campaign.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('campaign_edit')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $advertisers = \App\ContactCompany::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $ads = \App\Ad::get()->pluck('ad_label', 'id');


        $campaign = Campaign::findOrFail($id);

        return view('admin.campaigns.edit', compact('campaign', 'created_bies', 'created_by_teams', 'advertisers', 'ads'));
    }

    /**
     * Update Campaign in storage.
     *
     * @param  \App\Http\Requests\UpdateCampaignsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCampaignsRequest $request, $id)
    {
        if (! Gate::allows('campaign_edit')) {
            return abort(401);
        }
        $campaign = Campaign::findOrFail($id);
        $campaign->update($request->all());
        $campaign->ads()->sync(array_filter((array)$request->input('ads')));



        return redirect()->route('admin.campaigns.index');
    }


    /**
     * Display Campaign.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('campaign_view')) {
            return abort(401);
        }
        $campaign = Campaign::findOrFail($id);

        return view('admin.campaigns.show', compact('campaign'));
    }


    /**
     * Remove Campaign from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('campaign_delete')) {
            return abort(401);
        }
        $campaign = Campaign::findOrFail($id);
        $campaign->delete();

        return redirect()->route('admin.campaigns.index');
    }

    /**
     * Delete all selected Campaign at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('campaign_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Campaign::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Campaign from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('campaign_delete')) {
            return abort(401);
        }
        $campaign = Campaign::onlyTrashed()->findOrFail($id);
        $campaign->restore();

        return redirect()->route('admin.campaigns.index');
    }

    /**
     * Permanently delete Campaign from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('campaign_delete')) {
            return abort(401);
        }
        $campaign = Campaign::onlyTrashed()->findOrFail($id);
        $campaign->forceDelete();

        return redirect()->route('admin.campaigns.index');
    }
}
