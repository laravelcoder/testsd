<?php

namespace App\Http\Controllers\Api\V1;

use App\ContactCompany;
use Illuminate\Http\Request;
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

    public function index()
    {
        return ContactCompany::all();
    }

    public function show($id)
    {
        return ContactCompany::findOrFail($id);
    }

    public function update(UpdateContactCompaniesRequest $request, $id)
    {
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

        return $contact_company;
    }

    public function store(StoreContactCompaniesRequest $request)
    {
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

        return $contact_company;
    }

    public function destroy($id)
    {
        $contact_company = ContactCompany::findOrFail($id);
        $contact_company->delete();
        return '';
    }
}
