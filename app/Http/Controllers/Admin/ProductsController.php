<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductsRequest;
use App\Http\Requests\Admin\UpdateProductsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class ProductsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('product_access')) {
            return abort(401);
        }

        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating new Product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('product_create')) {
            return abort(401);
        }
        $categories = \App\Category::get()->pluck('title', 'id')->prepend('Выберите категорию', '');
       

        return view('admin.products.create', compact('categories', 'specifications'));
    }
      public function createProperties(Product $product)
    {
        if (! Gate::allows('product_create')) {
            return abort(401);
        }
         $property_values = $product->values();

        return view('admin.products.properties', compact('product', 'property_values'));
    }
    /**
     * Store a newly created Product in storage.
     *
     * @param  \App\Http\Requests\StoreProductsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductsRequest $request)
    {
        if (! Gate::allows('product_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $product = Product::create($request->all());
       


        foreach ($request->input('photos_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $product->id;
            $file->save();
        }

        return redirect()->route('admin.products.properties.create',$product);
    }
    
      public function storeProperties(Request $request,Product $product)
    {
         
        if (! Gate::allows('product_create')) {
            return abort(401);
        }
      
      
          if ($request->has('property')){
              
          $properties = $request->input('property');
     
         foreach($properties as $key=>$value){
                    
                    $product->setPropertyValue($key, $value);
                    
                }
             
          }
          
       


      

        return redirect()->route('admin.products.index');
    }


    /**
     * Show the form for editing Product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        if (! Gate::allows('product_edit')) {
            return abort(401);
        }
        $categories = \App\Category::get()->pluck('title', 'id')->prepend('Выберите категорию', '');
      
       
    
      
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update Product in storage.
     *
     * @param  \App\Http\Requests\UpdateProductsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductsRequest $request, Product $product)
    {
        if (! Gate::allows('product_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
       
       
        $product->update($request->all());
       
        $properties = $request->input('property');
     
         foreach($properties as $key=>$value){
                    
                    $product->setPropertyValue($key, $value);
                    
                }

       
        $media = [];
        foreach ($request->input('photos_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $product->id;
            $file->save();
            $media[] = $file;
        }
        $product->updateMedia($media, 'photos');

        return redirect()->route('admin.products.index');
    }


    /**
     * Display Product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        if (! Gate::allows('product_view')) {
            return abort(401);
        }
       

        return view('admin.products.show', compact('product'));
    }


    /**
     * Remove Product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('product_delete')) {
            return abort(401);
        }
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index');
    }

    /**
     * Delete all selected Product at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('product_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Product::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
