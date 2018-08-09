<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProvidersRequest;
use App\Http\Requests\Admin\UpdateProvidersRequest;
use App\Provider;

class ProvidersController extends Controller
{
    public function index()
    {
        return Provider::all();
    }

    public function show($id)
    {
        return Provider::findOrFail($id);
    }

    public function update(UpdateProvidersRequest $request, $id)
    {
        $provider = Provider::findOrFail($id);
        $provider->update($request->all());

        return $provider;
    }

    public function store(StoreProvidersRequest $request)
    {
        $provider = Provider::create($request->all());

        return $provider;
    }

    public function destroy($id)
    {
        $provider = Provider::findOrFail($id);
        $provider->delete();

        return '';
    }
}
