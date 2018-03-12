<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductsRequest;
use App\Http\Requests\Admin\UpdateProductsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Category;
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
        $categories = Category::get()->pluck('title', 'title');
        return view('admin.products.index', compact('products','categories'));
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
        $categories = Category::get();
        $categories_size_array = [];
        
       
        foreach ($categories as $category){
            $count = $category->products->count()+100;
            $articul = (string) $category->articul_code.'.'.$count;
          
       
            srand();
            while(Product::where('articul','=',$articul)->count()>0){
                $count = rand(100, 999);
                 $articul = $category->articul_code.'.'.$count;
            }
             
            $categories_size_array[$category->id] = $count;
        }
       
                
         $categories= $categories->pluck('title', 'id')->prepend('Выберите категорию', '');
        
       $brands = \App\Brand::get()->pluck('title', 'id')->prepend('Выберите производителя', '');
        $products = \App\Product::get()->pluck('title', 'id');
        $properties = collect();
        $categories_codes_array = Category::get()->pluck('articul_code','id')->toArray();
         
        $categories_codes_json = json_encode($categories_codes_array);
        $categories_size_json = json_encode($categories_size_array);
        return view('admin.products.create', compact('categories','brands','products', 'properties','categories_codes_json','categories_size_json'));
    }
      public function getProperties(Request $request)
    {
       
      $properties = collect();
      if($request->has('category_id')){
          $category = Category::find((int) $request->input('category_id'));
          if($category){
              $properties = $category->properties;
          }
          
      } 
     
        return view('admin.products.partials.properties', compact('properties'));
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
        $product->save();
         if ($request->has('property')){
              
          $properties = $request->input('property');
     
         foreach($properties as $key=>$value){
                    
                    $product->setPropertyValue($key, $value);
                    
                }
             
          }
          
       
           $product->products()->sync(array_filter((array)$request->input('products')));

      

        return redirect()->route('admin.products.index')->withSuccess('Товар добавлен');

      
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
        $brands = \App\Brand::get()->pluck('title', 'id')->prepend('Выберите производителя', '');
      
        $products = \App\Product::get()->pluck('title', 'id')->prepend('Добавьте сопутствующие товары', '');
        
      
        return view('admin.products.edit', compact('product', 'categories','brands','products'));
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
        $product->products()->sync(array_filter((array)$request->input('products')));
        
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
    
     public function copy(Product $product)
    {
       
      
     
       
        $product_copy =  $product->replicate();
        
   
       
        $product_copy->title='Копия '.$product_copy->title;
        if($product->category){
            $product_code = $product->category->products->count()+100;
            $product_copy->articul = $product->category->articul_code.'.'.$product_code;
        }
      
        $product_copy->save();
        
         if($product->products){
             $products_ids = $product->products->pluck('id')->toArray();
               $product_copy->products()->sync($products_ids);
         }
         
     
        
        if($product->getProperties()->count()){
            $properties = [];
          
            foreach ($product->getProperties() as $property){
                 $properties[$property->id] = $property->getOriginalValue($product->id);
                
            }
          //  var_dump($properties);
               
            foreach($properties as $key=>$value){
                    
                    $product_copy->setPropertyValue($key, $value);
                    
                }
          //   dd($product_copy->values());   
        }
        
        

       
        $media = [];
        foreach($product->getMedia('photos') as $media){
      
          $product_copy->addMediaFromUrl(url('/').$media->getUrl())->toCollection('photos');
          
        }
       
      
        
        return redirect()->route('admin.products.edit',[$product_copy->id]);
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
    public function destroy(Product $product)
    {
        if (! Gate::allows('product_delete')) {
            return abort(401);
        }
       
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
