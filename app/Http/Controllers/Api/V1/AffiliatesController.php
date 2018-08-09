<?php

namespace App\Http\Controllers\Api\V1;

use App\Affiliate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAffiliatesRequest;
use App\Http\Requests\Admin\UpdateAffiliatesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class AffiliatesController extends Controller
{
    public function index()
    {
        return Affiliate::all();
    }

    public function show($id)
    {
        return Affiliate::findOrFail($id);
    }

    public function update(UpdateAffiliatesRequest $request, $id)
    {
        $affiliate = Affiliate::findOrFail($id);
        $affiliate->update($request->all());
        

        return $affiliate;
    }

    public function store(StoreAffiliatesRequest $request)
    {
        $affiliate = Affiliate::create($request->all());
        

        return $affiliate;
    }

    public function destroy($id)
    {
        $affiliate = Affiliate::findOrFail($id);
        $affiliate->delete();
        return '';
    }
}
