<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoriesRequest;
use App\Http\Requests\Admin\UpdateCategoriesRequest;

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

        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
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
         $properties = \App\Models\Catalog\Property::get()->pluck('title', 'id');
         $menus = \App\Menu::get()->pluck('title', 'id')->prepend('Выберите меню', '');
        return view('admin.categories.create',  compact('properties','menus'));
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

        $category->properties()->sync(array_filter((array)$request->input('properties')));

        return redirect()->route('admin.categories.index');
    }


    /**
     * Show the form for editing Category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (! Gate::allows('category_edit')) {
            return abort(401);
        }
       
        $properties = \App\Models\Catalog\Property::get()->pluck('title', 'id');
         $menus = \App\Menu::get()->pluck('title', 'id')->prepend('Выберите меню', '');
        return view('admin.categories.edit', compact('category','properties','menus'));
    }

    /**
     * Update Category in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
       
      
        $category->update($request->all());
        $category->properties()->sync(array_filter((array)$request->input('properties')));


        return redirect()->route('admin.categories.index');
    }


    /**
     * Display Category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if (! Gate::allows('category_view')) {
            return abort(401);
        }
       

       // $category = Category::findOrFail($id);
     
        return view('admin.categories.show', compact('category', 'products'));
    }


    /**
     * Remove Category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (! Gate::allows('category_delete')) {
            return abort(401);
        }
      
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

}
