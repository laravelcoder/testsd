<?php

namespace App\Http\Controllers\Api\V1;

use App\ContactCompany;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Admin\StoreContactCompaniesRequest;
use App\Http\Requests\Admin\UpdateContactCompaniesRequest;

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

        $contacts = $contact_company->contacts;
        $currentContactData = [];
        foreach ($request->input('contacts', []) as $index => $data) {
            if (is_int($index)) {
                $contact_company->contacts()->create($data);
            } else {
                $id = explode('-', $index)[1];
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
        $phones = $contact_company->phones;
        $currentPhoneData = [];
        foreach ($request->input('phones', []) as $index => $data) {
            if (is_int($index)) {
                $contact_company->phones()->create($data);
            } else {
                $id = explode('-', $index)[1];
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
        $ads = $contact_company->ads;
        $currentAdData = [];
        foreach ($request->input('ads', []) as $index => $data) {
            if (is_int($index)) {
                $contact_company->ads()->create($data);
            } else {
                $id = explode('-', $index)[1];
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
