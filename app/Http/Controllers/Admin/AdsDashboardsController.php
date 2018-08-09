<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdsDashboardsController extends Controller
{
    public function index()
    {
        if (!Gate::allows('ads_dashboard_access')) {
            return abort(401);
        }

        return view('admin.ads_dashboards.index');
    }
}
