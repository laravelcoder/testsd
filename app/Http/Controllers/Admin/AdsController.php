<?php

namespace App\Http\Controllers\Admin;

use App\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdsRequest;
use App\Http\Requests\Admin\UpdateAdsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class AdsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Ad.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('ad_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Ad.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Ad.filter', 'my');
            }
        }

        
        if (request()->ajax()) {
            $query = Ad::query();
            $query->with("advertiser");
            $query->with("created_by");
            $query->with("created_by_team");
            $query->with("category_id");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('ad_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'ads.id',
                'ads.ad_label',
                'ads.ad_description',
                'ads.video_upload',
                'ads.total_impressions',
                'ads.total_networks',
                'ads.total_channels',
                'ads.advertiser_id',
                'ads.created_by_id',
                'ads.created_by_team_id',
                'ads.video_screenshot',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'ad_';
                $routeKey = 'admin.ads';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('ad_description', function ($row) {
                return $row->ad_description ? $row->ad_description : '';
            });
            $table->editColumn('video_upload', function ($row) {
                if($row->video_upload) { return '<a href="'.asset(env('UPLOAD_PATH').'/'.$row->video_upload) .'" target="_blank">Download file</a>'; };
            });
            $table->editColumn('total_impressions', function ($row) {
                return $row->total_impressions ? $row->total_impressions : '';
            });
            $table->editColumn('total_networks', function ($row) {
                return $row->total_networks ? $row->total_networks : '';
            });
            $table->editColumn('total_channels', function ($row) {
                return $row->total_channels ? $row->total_channels : '';
            });
            $table->editColumn('advertiser.name', function ($row) {
                return $row->advertiser ? $row->advertiser->name : '';
            });
            $table->editColumn('created_by.name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });
            $table->editColumn('created_by_team.name', function ($row) {
                return $row->created_by_team ? $row->created_by_team->name : '';
            });
            $table->editColumn('category_id.category', function ($row) {
                if(count($row->category_id) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->category_id->pluck('category')->toArray()) . '</span>';
            });
            $table->editColumn('video_screenshot', function ($row) {
                if($row->video_screenshot) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->video_screenshot) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->video_screenshot) .'"/>'; };
            });

            $table->rawColumns(['actions','massDelete','video_upload','category_id.category','video_screenshot']);

            return $table->make(true);
        }

        return view('admin.ads.index');
    }

    /**
     * Show the form for creating new Ad.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('ad_create')) {
            return abort(401);
        }
        
        $advertisers = \App\ContactCompany::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $category_ids = \App\Category::get()->pluck('category', 'id');


        return view('admin.ads.create', compact('advertisers', 'created_bies', 'created_by_teams', 'category_ids'));
    }

    /**
     * Store a newly created Ad in storage.
     *
     * @param  \App\Http\Requests\StoreAdsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdsRequest $request)
    {
        if (! Gate::allows('ad_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $ad = Ad::create($request->all());
        $ad->category_id()->sync(array_filter((array)$request->input('category_id')));



        return redirect()->route('admin.ads.index');
    }


    /**
     * Show the form for editing Ad.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('ad_edit')) {
            return abort(401);
        }
        
        $advertisers = \App\ContactCompany::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $category_ids = \App\Category::get()->pluck('category', 'id');


        $ad = Ad::findOrFail($id);

        return view('admin.ads.edit', compact('ad', 'advertisers', 'created_bies', 'created_by_teams', 'category_ids'));
    }

    /**
     * Update Ad in storage.
     *
     * @param  \App\Http\Requests\UpdateAdsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdsRequest $request, $id)
    {
        if (! Gate::allows('ad_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $ad = Ad::findOrFail($id);
        $ad->update($request->all());
        $ad->category_id()->sync(array_filter((array)$request->input('category_id')));



        return redirect()->route('admin.ads.index');
    }


    /**
     * Display Ad.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('ad_view')) {
            return abort(401);
        }
        
        $advertisers = \App\ContactCompany::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $category_ids = \App\Category::get()->pluck('category', 'id');
$categories = \App\Category::whereHas('ad_id',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$campaigns = \App\Campaign::whereHas('ads',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $ad = Ad::findOrFail($id);

        return view('admin.ads.show', compact('ad', 'categories', 'campaigns'));
    }


    /**
     * Remove Ad from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('ad_delete')) {
            return abort(401);
        }
        $ad = Ad::findOrFail($id);
        $ad->delete();

        return redirect()->route('admin.ads.index');
    }

    /**
     * Delete all selected Ad at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('ad_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Ad::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Ad from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('ad_delete')) {
            return abort(401);
        }
        $ad = Ad::onlyTrashed()->findOrFail($id);
        $ad->restore();

        return redirect()->route('admin.ads.index');
    }

    /**
     * Permanently delete Ad from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('ad_delete')) {
            return abort(401);
        }
        $ad = Ad::onlyTrashed()->findOrFail($id);
        $ad->forceDelete();

        return redirect()->route('admin.ads.index');
    }
}
