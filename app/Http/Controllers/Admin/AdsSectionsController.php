<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdsSectionsController extends Controller
{
    public function index()
    {
        if (!Gate::allows('ads_section_access')) {
            return abort(401);
        }

        return view('admin.ads_sections.index');
    }
}
