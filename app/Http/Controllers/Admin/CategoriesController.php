<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoriesRequest;
use App\Http\Requests\Admin\UpdateCategoriesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CategoriesController extends Controller
{
    /**
     * Display a listing of Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('category_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Category::query();
            $query->with("advertiser_id");
            $query->with("ad_id");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('category_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'categories.id',
                'categories.category',
                'categories.slug',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'category_';
                $routeKey = 'admin.categories';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('category', function ($row) {
                return $row->category ? $row->category : '';
            });
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : '';
            });
            $table->editColumn('advertiser_id.name', function ($row) {
                if(count($row->advertiser_id) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->advertiser_id->pluck('name')->toArray()) . '</span>';
            });
            $table->editColumn('ad_id.ad_label', function ($row) {
                if(count($row->ad_id) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->ad_id->pluck('ad_label')->toArray()) . '</span>';
            });

            $table->rawColumns(['actions','massDelete','advertiser_id.name','ad_id.ad_label']);

            return $table->make(true);
        }

        return view('admin.categories.index');
    }

    /**
     * Show the form for creating new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('category_create')) {
            return abort(401);
        }
        
        $advertiser_ids = \App\ContactCompany::get()->pluck('name', 'id');

        $ad_ids = \App\Ad::get()->pluck('ad_label', 'id');


        return view('admin.categories.create', compact('advertiser_ids', 'ad_ids'));
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param  \App\Http\Requests\StoreCategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoriesRequest $request)
    {
        if (! Gate::allows('category_create')) {
            return abort(401);
        }
        $category = Category::create($request->all());
        $category->advertiser_id()->sync(array_filter((array)$request->input('advertiser_id')));
        $category->ad_id()->sync(array_filter((array)$request->input('ad_id')));



        return redirect()->route('admin.categories.index');
    }


    /**
     * Show the form for editing Category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('category_edit')) {
            return abort(401);
        }
        
        $advertiser_ids = \App\ContactCompany::get()->pluck('name', 'id');

        $ad_ids = \App\Ad::get()->pluck('ad_label', 'id');


        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category', 'advertiser_ids', 'ad_ids'));
    }

    /**
     * Update Category in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriesRequest $request, $id)
    {
        if (! Gate::allows('category_edit')) {
            return abort(401);
        }
        $category = Category::findOrFail($id);
        $category->update($request->all());
        $category->advertiser_id()->sync(array_filter((array)$request->input('advertiser_id')));
        $category->ad_id()->sync(array_filter((array)$request->input('ad_id')));



        return redirect()->route('admin.categories.index');
    }


    /**
     * Display Category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('category_view')) {
            return abort(401);
        }
        
        $advertiser_ids = \App\ContactCompany::get()->pluck('name', 'id');

        $ad_ids = \App\Ad::get()->pluck('ad_label', 'id');
$ads = \App\Ad::whereHas('category_id',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $category = Category::findOrFail($id);

        return view('admin.categories.show', compact('category', 'ads'));
    }


    /**
     * Remove Category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('category_delete')) {
            return abort(401);
        }
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index');
    }

    /**
     * Delete all selected Category at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('category_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Category::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('category_delete')) {
            return abort(401);
        }
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('admin.categories.index');
    }

    /**
     * Permanently delete Category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('category_delete')) {
            return abort(401);
        }
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->route('admin.categories.index');
    }
}
