<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMenusRequest;
use App\Http\Requests\Admin\UpdateMenusRequest;

class MenusController extends Controller
{
    /**
     * Display a listing of Menu.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('menu_access')) {
            return abort(401);
        }

        $menus = Menu::all();

        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating new Menu.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('menu_create')) {
            return abort(401);
        }
          $items = \App\Item::get()->pluck('title', 'id');
        return view('admin.menus.create',compact('items'));
    }

    /**
     * Store a newly created Menu in storage.
     *
     * @param  \App\Http\Requests\StoreMenusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenusRequest $request)
    {
        if (! Gate::allows('menu_create')) {
            return abort(401);
        }
        $menu = Menu::create($request->all());

         $menu->items()->sync(array_filter((array)$request->input('items')));

        return redirect()->route('admin.menus.index');
    }


    /**
     * Show the form for editing Menu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('menu_edit')) {
            return abort(401);
        }
         $items = \App\Item::get()->pluck('title', 'id');
        $menu = Menu::findOrFail($id);

        return view('admin.menus.edit', compact('menu','items'));
    }

    /**
     * Update Menu in storage.
     *
     * @param  \App\Http\Requests\UpdateMenusRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenusRequest $request, $id)
    {
        if (! Gate::allows('menu_edit')) {
            return abort(401);
        }
        $menu = Menu::findOrFail($id);
        $menu->update($request->all());
        $menu->items()->sync(array_filter((array)$request->input('items')));

        return redirect()->route('admin.menus.index');
    }


    /**
     * Remove Menu from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('menu_delete')) {
            return abort(401);
        }
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menus.index');
    }

    /**
     * Delete all selected Menu at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('menu_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Menu::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
