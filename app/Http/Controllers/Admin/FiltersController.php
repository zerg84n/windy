<?php

namespace App\Http\Controllers\Admin;

use App\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFiltersRequest;
use App\Http\Requests\Admin\UpdateFiltersRequest;

class FiltersController extends Controller
{
    /**
     * Display a listing of Filter.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('filter_access')) {
            return abort(401);
        }


                $filters = Filter::all();

        return view('admin.filters.index', compact('filters'));
    }

    /**
     * Show the form for creating new Filter.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('filter_create')) {
            return abort(401);
        }
        return view('admin.filters.create');
    }

    /**
     * Store a newly created Filter in storage.
     *
     * @param  \App\Http\Requests\StoreFiltersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFiltersRequest $request)
    {
        if (! Gate::allows('filter_create')) {
            return abort(401);
        }
        $filter = Filter::create($request->all());



        return redirect()->route('admin.filters.index');
    }


    /**
     * Show the form for editing Filter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('filter_edit')) {
            return abort(401);
        }
        $filter = Filter::findOrFail($id);

        return view('admin.filters.edit', compact('filter'));
    }

    /**
     * Update Filter in storage.
     *
     * @param  \App\Http\Requests\UpdateFiltersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFiltersRequest $request, $id)
    {
        if (! Gate::allows('filter_edit')) {
            return abort(401);
        }
        $filter = Filter::findOrFail($id);
        $filter->update($request->all());



        return redirect()->route('admin.filters.index');
    }


    /**
     * Display Filter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('filter_view')) {
            return abort(401);
        }
        $filter = Filter::findOrFail($id);

        return view('admin.filters.show', compact('filter'));
    }


    /**
     * Remove Filter from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('filter_delete')) {
            return abort(401);
        }
        $filter = Filter::findOrFail($id);
        $filter->delete();

        return redirect()->route('admin.filters.index');
    }

    /**
     * Delete all selected Filter at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('filter_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Filter::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
