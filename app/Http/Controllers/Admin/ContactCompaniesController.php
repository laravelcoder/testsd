<?php

namespace App\Http\Controllers\Admin;

use App\ContactCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContactCompaniesRequest;
use App\Http\Requests\Admin\UpdateContactCompaniesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ContactCompaniesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of ContactCompany.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('contact_company_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('ContactCompany.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('ContactCompany.filter', 'my');
            }
        }

        
        if (request()->ajax()) {
            $query = ContactCompany::query();
            $query->with("created_by");
            $query->with("created_by_team");
            $template = 'actionsTemplate';
            
            $query->select([
                'contact_companies.id',
                'contact_companies.name',
                'contact_companies.website',
                'contact_companies.email',
                'contact_companies.address',
                'contact_companies.address2',
                'contact_companies.city',
                'contact_companies.state',
                'contact_companies.zipcode',
                'contact_companies.country',
                'contact_companies.logo',
                'contact_companies.created_by_id',
                'contact_companies.created_by_team_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'contact_company_';
                $routeKey = 'admin.contact_companies';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('website', function ($row) {
                return $row->website ? $row->website : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('address2', function ($row) {
                return $row->address2 ? $row->address2 : '';
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : '';
            });
            $table->editColumn('state', function ($row) {
                return $row->state ? $row->state : '';
            });
            $table->editColumn('zipcode', function ($row) {
                return $row->zipcode ? $row->zipcode : '';
            });
            $table->editColumn('country', function ($row) {
                return $row->country ? $row->country : '';
            });
            $table->editColumn('logo', function ($row) {
                if($row->logo) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->logo) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->logo) .'"/>'; };
            });
            $table->editColumn('created_by.name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });
            $table->editColumn('created_by_team.name', function ($row) {
                return $row->created_by_team ? $row->created_by_team->name : '';
            });

            $table->rawColumns(['actions','massDelete','logo']);

            return $table->make(true);
        }

        return view('admin.contact_companies.index');
    }

    /**
     * Show the form for creating new ContactCompany.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('contact_company_create')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.contact_companies.create', compact('created_bies', 'created_by_teams'));
    }

    /**
     * Store a newly created ContactCompany in storage.
     *
     * @param  \App\Http\Requests\StoreContactCompaniesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactCompaniesRequest $request)
    {
        if (! Gate::allows('contact_company_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $contact_company = ContactCompany::create($request->all());

        foreach ($request->input('contacts', []) as $data) {
            $contact_company->contacts()->create($data);
        }
        foreach ($request->input('phones', []) as $data) {
            $contact_company->phones()->create($data);
        }
        foreach ($request->input('campaigns', []) as $data) {
            $contact_company->campaigns()->create($data);
        }
        foreach ($request->input('ads', []) as $data) {
            $contact_company->ads()->create($data);
        }


        return redirect()->route('admin.contact_companies.index');
    }


    /**
     * Show the form for editing ContactCompany.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('contact_company_edit')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $contact_company = ContactCompany::findOrFail($id);

        return view('admin.contact_companies.edit', compact('contact_company', 'created_bies', 'created_by_teams'));
    }

    /**
     * Update ContactCompany in storage.
     *
     * @param  \App\Http\Requests\UpdateContactCompaniesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactCompaniesRequest $request, $id)
    {
        if (! Gate::allows('contact_company_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $contact_company = ContactCompany::findOrFail($id);
        $contact_company->update($request->all());

        $contacts           = $contact_company->contacts;
        $currentContactData = [];
        foreach ($request->input('contacts', []) as $index => $data) {
            if (is_integer($index)) {
                $contact_company->contacts()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentContactData[$id] = $data;
            }
        }
        foreach ($contacts as $item) {
            if (isset($currentContactData[$item->id])) {
                $item->update($currentContactData[$item->id]);
            } else {
                $item->delete();
            }
        }
        $phones           = $contact_company->phones;
        $currentPhoneData = [];
        foreach ($request->input('phones', []) as $index => $data) {
            if (is_integer($index)) {
                $contact_company->phones()->create($data);
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
        $campaigns           = $contact_company->campaigns;
        $currentCampaignData = [];
        foreach ($request->input('campaigns', []) as $index => $data) {
            if (is_integer($index)) {
                $contact_company->campaigns()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentCampaignData[$id] = $data;
            }
        }
        foreach ($campaigns as $item) {
            if (isset($currentCampaignData[$item->id])) {
                $item->update($currentCampaignData[$item->id]);
            } else {
                $item->delete();
            }
        }
        $ads           = $contact_company->ads;
        $currentAdData = [];
        foreach ($request->input('ads', []) as $index => $data) {
            if (is_integer($index)) {
                $contact_company->ads()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentAdData[$id] = $data;
            }
        }
        foreach ($ads as $item) {
            if (isset($currentAdData[$item->id])) {
                $item->update($currentAdData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.contact_companies.index');
    }


    /**
     * Display ContactCompany.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('contact_company_view')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$contacts = \App\Contact::where('company_id', $id)->get();$agents = \App\Agent::where('advertiser_id', $id)->get();$categories = \App\Category::whereHas('advertiser_id',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$phones = \App\Phone::where('advertiser_id', $id)->get();$audiences = \App\Audience::where('advertiser_id', $id)->get();$demographics = \App\Demographic::where('advertiser_id', $id)->get();$campaigns = \App\Campaign::where('advertiser_id', $id)->get();$ads = \App\Ad::where('advertiser_id', $id)->get();

        $contact_company = ContactCompany::findOrFail($id);

        return view('admin.contact_companies.show', compact('contact_company', 'contacts', 'agents', 'categories', 'phones', 'audiences', 'demographics', 'campaigns', 'ads'));
    }


    /**
     * Remove ContactCompany from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('contact_company_delete')) {
            return abort(401);
        }
        $contact_company = ContactCompany::findOrFail($id);
        $contact_company->delete();

        return redirect()->route('admin.contact_companies.index');
    }

    /**
     * Delete all selected ContactCompany at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('contact_company_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ContactCompany::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
