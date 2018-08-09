<?php

namespace App\Http\Controllers\Admin;

use App\Affiliate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAffiliatesRequest;
use App\Http\Requests\Admin\UpdateAffiliatesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class AffiliatesController extends Controller
{
    /**
     * Display a listing of Affiliate.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('affiliate_access')) {
            return abort(401);
        }

        if (request()->ajax()) {
            $query = Affiliate::query();
            $template = 'actionsTemplate';
            if (request('show_deleted') == 1) {
                if (!Gate::allows('affiliate_delete')) {
                    return abort(401);
                }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'affiliates.id',
                'affiliates.affiliate',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey = 'affiliate_';
                $routeKey = 'admin.affiliates';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('affiliate', function ($row) {
                return $row->affiliate ? $row->affiliate : '';
            });

            $table->rawColumns(['actions', 'massDelete']);

            return $table->make(true);
        }

        return view('admin.affiliates.index');
    }

    /**
     * Show the form for creating new Affiliate.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('affiliate_create')) {
            return abort(401);
        }

        return view('admin.affiliates.create');
    }

    /**
     * Store a newly created Affiliate in storage.
     *
     * @param \App\Http\Requests\StoreAffiliatesRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAffiliatesRequest $request)
    {
        if (!Gate::allows('affiliate_create')) {
            return abort(401);
        }
        $affiliate = Affiliate::create($request->all());

        foreach ($request->input('stations', []) as $data) {
            $affiliate->stations()->create($data);
        }

        return redirect()->route('admin.affiliates.index');
    }

    /**
     * Show the form for editing Affiliate.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('affiliate_edit')) {
            return abort(401);
        }
        $affiliate = Affiliate::findOrFail($id);

        return view('admin.affiliates.edit', compact('affiliate'));
    }

    /**
     * Update Affiliate in storage.
     *
     * @param \App\Http\Requests\UpdateAffiliatesRequest $request
     * @param int                                        $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAffiliatesRequest $request, $id)
    {
        if (!Gate::allows('affiliate_edit')) {
            return abort(401);
        }
        $affiliate = Affiliate::findOrFail($id);
        $affiliate->update($request->all());

        $stations = $affiliate->stations;
        $currentStationData = [];
        foreach ($request->input('stations', []) as $index => $data) {
            if (is_int($index)) {
                $affiliate->stations()->create($data);
            } else {
                $id = explode('-', $index)[1];
                $currentStationData[$id] = $data;
            }
        }
        foreach ($stations as $item) {
            if (isset($currentStationData[$item->id])) {
                $item->update($currentStationData[$item->id]);
            } else {
                $item->delete();
            }
        }

        return redirect()->route('admin.affiliates.index');
    }

    /**
     * Display Affiliate.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('affiliate_view')) {
            return abort(401);
        }
        $stations = \App\Station::where('affiliate_id', $id)->get();
        $networks = \App\Network::whereHas('affiliates',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $affiliate = Affiliate::findOrFail($id);

        return view('admin.affiliates.show', compact('affiliate', 'stations', 'networks'));
    }

    /**
     * Remove Affiliate from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('affiliate_delete')) {
            return abort(401);
        }
        $affiliate = Affiliate::findOrFail($id);
        $affiliate->delete();

        return redirect()->route('admin.affiliates.index');
    }

    /**
     * Delete all selected Affiliate at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('affiliate_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Affiliate::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    /**
     * Restore Affiliate from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('affiliate_delete')) {
            return abort(401);
        }
        $affiliate = Affiliate::onlyTrashed()->findOrFail($id);
        $affiliate->restore();

        return redirect()->route('admin.affiliates.index');
    }

    /**
     * Permanently delete Affiliate from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (!Gate::allows('affiliate_delete')) {
            return abort(401);
        }
        $affiliate = Affiliate::onlyTrashed()->findOrFail($id);
        $affiliate->forceDelete();

        return redirect()->route('admin.affiliates.index');
    }
}
