<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTeamsRequest;
use App\Http\Requests\Admin\UpdateTeamsRequest;
use App\Team;

class TeamsController extends Controller
{
    public function index()
    {
        return Team::all();
    }

    public function show($id)
    {
        return Team::findOrFail($id);
    }

    public function update(UpdateTeamsRequest $request, $id)
    {
        $team = Team::findOrFail($id);
        $team->update($request->all());

        return $team;
    }

    public function store(StoreTeamsRequest $request)
    {
        $team = Team::create($request->all());

        return $team;
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return '';
    }
}
