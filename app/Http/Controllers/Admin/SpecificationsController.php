<?php

namespace App\Http\Controllers\Admin;

use App\Specification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSpecificationsRequest;
use App\Http\Requests\Admin\UpdateSpecificationsRequest;

class SpecificationsController extends Controller
{
    /**
     * Display a listing of Specification.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('specification_access')) {
            return abort(401);
        }

        $specifications = Specification::all();

        return view('admin.specifications.index', compact('specifications'));
    }

    /**
     * Show the form for creating new Specification.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('specification_create')) {
            return abort(401);
        }
        return view('admin.specifications.create');
    }

    /**
     * Store a newly created Specification in storage.
     *
     * @param  \App\Http\Requests\StoreSpecificationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpecificationsRequest $request)
    {
        if (! Gate::allows('specification_create')) {
            return abort(401);
        }
        $specification = Specification::create($request->all());



        return redirect()->route('admin.specifications.index');
    }


    /**
     * Show the form for editing Specification.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('specification_edit')) {
            return abort(401);
        }
        $specification = Specification::findOrFail($id);

        return view('admin.specifications.edit', compact('specification'));
    }

    /**
     * Update Specification in storage.
     *
     * @param  \App\Http\Requests\UpdateSpecificationsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpecificationsRequest $request, $id)
    {
        if (! Gate::allows('specification_edit')) {
            return abort(401);
        }
        $specification = Specification::findOrFail($id);
        $specification->update($request->all());



        return redirect()->route('admin.specifications.index');
    }


    /**
     * Display Specification.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('specification_view')) {
            return abort(401);
        }
        $products = \App\Product::whereHas('specifications',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $specification = Specification::findOrFail($id);

        return view('admin.specifications.show', compact('specification', 'products'));
    }


    /**
     * Remove Specification from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('specification_delete')) {
            return abort(401);
        }
        $specification = Specification::findOrFail($id);
        $specification->delete();

        return redirect()->route('admin.specifications.index');
    }

    /**
     * Delete all selected Specification at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('specification_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Specification::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
