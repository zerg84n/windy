<?php

namespace App\Http\Controllers\Admin;

use App\Models\Catalog\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSpecificationsRequest;
use App\Http\Requests\Admin\UpdateSpecificationsRequest;
use App\Models\Catalog\Variant;
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

        $specifications = Property::all();

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
         
         $value_types = Property::FORM_TYPES;
        return view('admin.specifications.create',  compact('value_types'));
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
       
        
        $specification = Property::create($request->all());

        if ($request->input('value_type')=='select'){
            if ($request->has('variants')){
                foreach($request->input('variants') as $variant){
                    \App\Models\Catalog\Variant::create([
                        'property_id'=>$specification->id,
                        'value'=>$variant
                    ]);
                }
            }else{
                return back()->withErrors('Не указаны варианты!');
            }
        }

        return redirect()->route('admin.specifications.index');
    }


    /**
     * Show the form for editing Specification.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $specification)
    {
        if (! Gate::allows('specification_edit')) {
            return abort(401);
        }
    
        
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
       
        $specification = Property::findOrFail($id);
        $specification->update($request->all());
         if ($specification->variants){
            if ($request->has('old_variants')){
                $updated_variants = collect($request->input('old_variants'));
               
                $variants = $specification->variants->pluck('id');
                $deleted_variants = $variants->diff($updated_variants->keys());
                foreach($deleted_variants as $variant){
                    Variant::destroy($variant);
                }
                foreach ($updated_variants as $key=>$value){
                    $variant = Variant::find($key);
                    $variant->value=$value;
                    $variant->save();
                }
            }
            if ($request->has('new_variants')){
                foreach($request->input('new_variants') as $variant){
                    $variant = Variant::create([
                            'property_id'=>$specification->id,
                            'value'=>$variant
                            ]);
                }
            }
            
            
        }


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
      
        
        $specification = Property::findOrFail($id);
        $categories = $specification->categories;
        return view('admin.specifications.show', compact('specification', 'categories'));
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
        $specification = Property::findOrFail($id);
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
            $entries = Property::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
