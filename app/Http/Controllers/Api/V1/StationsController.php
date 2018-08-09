<?php

namespace App\Http\Controllers\Api\V1;

use App\Station;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStationsRequest;
use App\Http\Requests\Admin\UpdateStationsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class StationsController extends Controller
{
    public function index()
    {
        return Station::all();
    }

    public function show($id)
    {
        return Station::findOrFail($id);
    }

    public function update(UpdateStationsRequest $request, $id)
    {
        $station = Station::findOrFail($id);
        $station->update($request->all());
        

        return $station;
    }

    public function store(StoreStationsRequest $request)
    {
        $station = Station::create($request->all());
        

        return $station;
    }

    public function destroy($id)
    {
        $station = Station::findOrFail($id);
        $station->delete();
        return '';
    }
}
