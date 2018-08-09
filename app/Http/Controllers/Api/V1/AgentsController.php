<?php

namespace App\Http\Controllers\Api\V1;

use App\Agent;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Admin\StoreAgentsRequest;
use App\Http\Requests\Admin\UpdateAgentsRequest;

class AgentsController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Agent::all();
    }

    public function show($id)
    {
        return Agent::findOrFail($id);
    }

    public function update(UpdateAgentsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $agent = Agent::findOrFail($id);
        $agent->update($request->all());

        $phones = $agent->phones;
        $currentPhoneData = [];
        foreach ($request->input('phones', []) as $index => $data) {
            if (is_int($index)) {
                $agent->phones()->create($data);
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

        return $agent;
    }

    public function store(StoreAgentsRequest $request)
    {
        $request = $this->saveFiles($request);
        $agent = Agent::create($request->all());

        foreach ($request->input('phones', []) as $data) {
            $agent->phones()->create($data);
        }

        return $agent;
    }

    public function destroy($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->delete();

        return '';
    }
}
