<?php

namespace App\Http\Controllers\Admin;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreItemsRequest;
use App\Http\Requests\Admin\UpdateItemsRequest;

class ItemsController extends Controller
{
    /**
     * Display a listing of Item.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('item_access')) {
            return abort(401);
        }

        $items = Item::all();
        $menus = \App\Menu::get()->pluck('title', 'title')->prepend('Показать все','');
        return view('admin.items.index', compact('items','menus'));
    }

    /**
     * Show the form for creating new Item.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('item_create')) {
            return abort(401);
        }
        $menuses = \App\Menu::get()->pluck('title', 'id');

        return view('admin.items.create', compact('menuses'));
    }

    /**
     * Store a newly created Item in storage.
     *
     * @param  \App\Http\Requests\StoreItemsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemsRequest $request)
    {
        if (! Gate::allows('item_create')) {
            return abort(401);
        }
        $item = Item::create($request->all());
        $item->menus()->sync(array_filter((array)$request->input('menus')));



        return redirect()->route('admin.items.index');
    }


    /**
     * Show the form for editing Item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('item_edit')) {
            return abort(401);
        }
        $menuses = \App\Menu::get()->pluck('title', 'id');

        $item = Item::findOrFail($id);

        return view('admin.items.edit', compact('item', 'menuses'));
    }

    /**
     * Update Item in storage.
     *
     * @param  \App\Http\Requests\UpdateItemsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemsRequest $request, $id)
    {
        if (! Gate::allows('item_edit')) {
            return abort(401);
        }
        $item = Item::findOrFail($id);
        $item->update($request->all());
        $item->menus()->sync(array_filter((array)$request->input('menus')));



        return redirect()->route('admin.items.index');
    }


    /**
     * Remove Item from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('item_delete')) {
            return abort(401);
        }
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.items.index');
    }

    /**
     * Delete all selected Item at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('item_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Item::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
