<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePhonesRequest;
use App\Http\Requests\Admin\UpdatePhonesRequest;
use App\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class PhonesController extends Controller
{
    /**
     * Display a listing of Phone.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('phone_access')) {
            return abort(401);
        }

        if (request()->ajax()) {
            $query = Phone::query();
            $query->with('contact');
            $query->with('advertiser');
            $query->with('agent');
            $template = 'actionsTemplate';
            if (request('show_deleted') == 1) {
                if (!Gate::allows('phone_delete')) {
                    return abort(401);
                }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'phones.id',
                'phones.phone_number',
                'phones.contact_id',
                'phones.advertiser_id',
                'phones.agent_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey = 'phone_';
                $routeKey = 'admin.phones';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('contact.first_name', function ($row) {
                return $row->contact ? $row->contact->first_name : '';
            });
            $table->editColumn('advertiser.name', function ($row) {
                return $row->advertiser ? $row->advertiser->name : '';
            });
            $table->editColumn('agent.first_name', function ($row) {
                return $row->agent ? $row->agent->first_name : '';
            });

            $table->rawColumns(['actions', 'massDelete']);

            return $table->make(true);
        }

        return view('admin.phones.index');
    }

    /**
     * Show the form for creating new Phone.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('phone_create')) {
            return abort(401);
        }

        $contacts = \App\Contact::get()->pluck('first_name', 'id')->prepend(trans('global.app_please_select'), '');
        $advertisers = \App\ContactCompany::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $agents = \App\Agent::get()->pluck('first_name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.phones.create', compact('contacts', 'advertisers', 'agents'));
    }

    /**
     * Store a newly created Phone in storage.
     *
     * @param \App\Http\Requests\StorePhonesRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhonesRequest $request)
    {
        if (!Gate::allows('phone_create')) {
            return abort(401);
        }
        $phone = Phone::create($request->all());

        return redirect()->route('admin.phones.index');
    }

    /**
     * Show the form for editing Phone.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('phone_edit')) {
            return abort(401);
        }

        $contacts = \App\Contact::get()->pluck('first_name', 'id')->prepend(trans('global.app_please_select'), '');
        $advertisers = \App\ContactCompany::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $agents = \App\Agent::get()->pluck('first_name', 'id')->prepend(trans('global.app_please_select'), '');

        $phone = Phone::findOrFail($id);

        return view('admin.phones.edit', compact('phone', 'contacts', 'advertisers', 'agents'));
    }

    /**
     * Update Phone in storage.
     *
     * @param \App\Http\Requests\UpdatePhonesRequest $request
     * @param int                                    $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhonesRequest $request, $id)
    {
        if (!Gate::allows('phone_edit')) {
            return abort(401);
        }
        $phone = Phone::findOrFail($id);
        $phone->update($request->all());

        return redirect()->route('admin.phones.index');
    }

    /**
     * Display Phone.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('phone_view')) {
            return abort(401);
        }
        $phone = Phone::findOrFail($id);

        return view('admin.phones.show', compact('phone'));
    }

    /**
     * Remove Phone from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('phone_delete')) {
            return abort(401);
        }
        $phone = Phone::findOrFail($id);
        $phone->delete();

        return redirect()->route('admin.phones.index');
    }

    /**
     * Delete all selected Phone at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('phone_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Phone::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    /**
     * Restore Phone from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('phone_delete')) {
            return abort(401);
        }
        $phone = Phone::onlyTrashed()->findOrFail($id);
        $phone->restore();

        return redirect()->route('admin.phones.index');
    }

    /**
     * Permanently delete Phone from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (!Gate::allows('phone_delete')) {
            return abort(401);
        }
        $phone = Phone::onlyTrashed()->findOrFail($id);
        $phone->forceDelete();

        return redirect()->route('admin.phones.index');
    }
}
