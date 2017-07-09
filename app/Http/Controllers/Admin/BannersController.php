<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBannerRequest;
use App\Http\Requests\Admin\UpdateBannerRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class BannersController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Banner.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('banners_access')) {
            return abort(401);
        }

        $banners = Banner::all();

        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating new Banner.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('banners_create')) {
            return abort(401);
        }
        return view('admin.banners.create');
    }

    /**
     * Store a newly created Banner in storage.
     *
     * @param  \App\Http\Requests\StoreBannerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBannerRequest $request)
    {
        if (! Gate::allows('banners_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        
        $result =  $this->resizePhotos($request, 'photos');
      
        $banners = Banner::create($request->all());


        foreach ($request->input('photos_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $banners->id;
            $file->save();
        }

        return redirect()->route('admin.banners.index');
    }


    /**
     * Show the form for editing Banner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('banners_edit')) {
            return abort(401);
        }
        $banners = Banner::findOrFail($id);

        return view('admin.banners.edit', compact('banners'));
    }

    /**
     * Update Banner in storage.
     *
     * @param  \App\Http\Requests\UpdateBannerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request, $id)
    {
        if (! Gate::allows('banners_edit')) {
            return abort(401);
        }
        
       
        
        $request = $this->saveFiles($request);
        
        $this->resizePhotos($request, 'photos');
        
        
        $banners = Banner::findOrFail($id);
        $banners->update($request->all());


        $media = [];
        foreach ($request->input('photos_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $banners->id;
            $file->save();
            $media[] = $file;
        }
        $banners->updateMedia($media, 'photos');

        return redirect()->route('admin.banners.index');
    }


    /**
     * Display Banner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('banners_view')) {
            return abort(401);
        }
        $banners = Banner::findOrFail($id);

        return view('admin.banners.show', compact('banners'));
    }


    /**
     * Remove Banner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('banners_delete')) {
            return abort(401);
        }
        $banners = Banner::findOrFail($id);
        $banners->delete();

        return redirect()->route('admin.banners.index');
    }

    /**
     * Delete all selected Banner at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('banners_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Banner::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
