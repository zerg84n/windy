<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBrandsRequest;
use App\Http\Requests\Admin\UpdateBrandsRequest;

class BrandsController extends Controller
{
    /**
     * Display a listing of Brand.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('brand_access')) {
            return abort(401);
        }


                $brands = Brand::all();

        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating new Brand.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('brand_create')) {
            return abort(401);
        }
        return view('admin.brands.create');
    }

    /**
     * Store a newly created Brand in storage.
     *
     * @param  \App\Http\Requests\StoreBrandsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandsRequest $request)
    {
        if (! Gate::allows('brand_create')) {
            return abort(401);
        }
        $brand = Brand::create($request->all());



        return redirect()->route('admin.brands.index');
    }


    /**
     * Show the form for editing Brand.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('brand_edit')) {
            return abort(401);
        }
        $brand = Brand::findOrFail($id);

        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update Brand in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandsRequest $request, $id)
    {
        if (! Gate::allows('brand_edit')) {
            return abort(401);
        }
        $brand = Brand::findOrFail($id);
        $brand->update($request->all());



        return redirect()->route('admin.brands.index');
    }


    /**
     * Display Brand.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('brand_view')) {
            return abort(401);
        }
        $brand = Brand::findOrFail($id);

        return view('admin.brands.show', compact('brand'));
    }


    /**
     * Remove Brand from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('brand_delete')) {
            return abort(401);
        }
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('admin.brands.index');
    }

    /**
     * Delete all selected Brand at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('brand_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Brand::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
