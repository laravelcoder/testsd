<?php

namespace App\Http\Controllers\Api\V1;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContactsRequest;
use App\Http\Requests\Admin\UpdateContactsRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ContactsController extends Controller
{
    public function index()
    {
        return Contact::all();
    }

    public function show($id)
    {
        return Contact::findOrFail($id);
    }

    public function update(UpdateContactsRequest $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update($request->all());
        
        $phones           = $contact->phones;
        $currentPhoneData = [];
        foreach ($request->input('phones', []) as $index => $data) {
            if (is_integer($index)) {
                $contact->phones()->create($data);
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

        return $contact;
    }

    public function store(StoreContactsRequest $request)
    {
        $contact = Contact::create($request->all());
        
        foreach ($request->input('phones', []) as $data) {
            $contact->phones()->create($data);
        }

        return $contact;
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return '';
    }
}
