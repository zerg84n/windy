<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePageRequest;
use App\Http\Requests\Admin\UpdatePageRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class PagesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('page_access')) {
            return abort(401);
        }

        $pages = Page::all();

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating new Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('page_create')) {
            return abort(401);
        }
        return view('admin.pages.create');
    }

    /**
     * Store a newly created Page in storage.
     *
     * @param  \App\Http\Requests\StorePageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
        if (! Gate::allows('page_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $page = Page::create($request->all());


        foreach ($request->input('photos_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $page->id;
            $file->save();
        }

        return redirect()->route('admin.pages.index');
    }


    /**
     * Show the form for editing Page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('page_edit')) {
            return abort(401);
        }
        $page = Page::findOrFail($id);

        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update Page in storage.
     *
     * @param  \App\Http\Requests\UpdatePageRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, $id)
    {
        if (! Gate::allows('page_edit')) {
            return abort(401);
        }
       
        $request = $this->saveFiles($request);
        $page = Page::findOrFail($id);
        $page->update($request->all());


        $media = [];
        foreach ($request->input('photos_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $page->id;
            $file->save();
            $media[] = $file;
        }
        $page->updateMedia($media, 'photos');

        return redirect()->route('admin.pages.index');
    }


    /**
     * Display Page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('page_view')) {
            return abort(401);
        }
        $page = Page::findOrFail($id);

        return view('admin.pages.show', compact('page'));
    }


    /**
     * Remove Page from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('page_delete')) {
            return abort(401);
        }
        $page = Page::findOrFail($id);
        $page->delete();

        return redirect()->route('admin.pages.index');
    }

    /**
     * Delete all selected Page at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('page_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Page::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
