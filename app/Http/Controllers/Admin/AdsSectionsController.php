<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class AdsSectionsController extends Controller
{
    public function index()
    {
        if (! Gate::allows('ads_section_access')) {
            return abort(401);
        }
        return view('admin.ads_sections.index');
    }
}
