<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProvidersRequest;
use App\Http\Requests\Admin\UpdateProvidersRequest;
use App\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class ProvidersController extends Controller
{
    /**
     * Display a listing of Provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('provider_access')) {
            return abort(401);
        }

        if (request()->ajax()) {
            $query = Provider::query();
            $template = 'actionsTemplate';
            if (request('show_deleted') == 1) {
                if (!Gate::allows('provider_delete')) {
                    return abort(401);
                }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'providers.id',
                'providers.provider',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey = 'provider_';
                $routeKey = 'admin.providers';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });

            $table->rawColumns(['actions', 'massDelete']);

            return $table->make(true);
        }

        return view('admin.providers.index');
    }

    /**
     * Show the form for creating new Provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('provider_create')) {
            return abort(401);
        }

        return view('admin.providers.create');
    }

    /**
     * Store a newly created Provider in storage.
     *
     * @param \App\Http\Requests\StoreProvidersRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProvidersRequest $request)
    {
        if (!Gate::allows('provider_create')) {
            return abort(401);
        }
        $provider = Provider::create($request->all());

        return redirect()->route('admin.providers.index');
    }

    /**
     * Show the form for editing Provider.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('provider_edit')) {
            return abort(401);
        }
        $provider = Provider::findOrFail($id);

        return view('admin.providers.edit', compact('provider'));
    }

    /**
     * Update Provider in storage.
     *
     * @param \App\Http\Requests\UpdateProvidersRequest $request
     * @param int                                       $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProvidersRequest $request, $id)
    {
        if (!Gate::allows('provider_edit')) {
            return abort(401);
        }
        $provider = Provider::findOrFail($id);
        $provider->update($request->all());

        return redirect()->route('admin.providers.index');
    }

    /**
     * Display Provider.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('provider_view')) {
            return abort(401);
        }
        $provider = Provider::findOrFail($id);

        return view('admin.providers.show', compact('provider'));
    }

    /**
     * Remove Provider from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('provider_delete')) {
            return abort(401);
        }
        $provider = Provider::findOrFail($id);
        $provider->delete();

        return redirect()->route('admin.providers.index');
    }

    /**
     * Delete all selected Provider at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('provider_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Provider::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    /**
     * Restore Provider from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('provider_delete')) {
            return abort(401);
        }
        $provider = Provider::onlyTrashed()->findOrFail($id);
        $provider->restore();

        return redirect()->route('admin.providers.index');
    }

    /**
     * Permanently delete Provider from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (!Gate::allows('provider_delete')) {
            return abort(401);
        }
        $provider = Provider::onlyTrashed()->findOrFail($id);
        $provider->forceDelete();

        return redirect()->route('admin.providers.index');
    }
}
