<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Product;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
  
        $news = \App\News::orderBy('id','desc')->limit(2)->get();
        $products = \App\Product::paginate(6);
        $slider = \App\Models\Banner::all()->first();
        return view('products.main',  compact('news','slider','products'));
    }
     public function catalog(Request $request)
    {
            
        if ($request->has('category')){
           $category = \App\Category::find($request->input('category'));
           if ($category){
               $products = $category->products()->paginate(6);
           } else {
               $products = \App\Product::paginate(6);
           }
        }else{
            $category = null;
            $products = \App\Product::paginate(6);
        }
        
        
      
        return view('products.catalog',  compact('products','category'));
    }
    
    
      public function compare_add(Request $request)
    {
          
          $id = $request->input('id');
           Session::put('basket.product'.$id, $id); 
        return  $id;
    }
      public function compare_del(Request $request)
    {
          $id = $request->input('id');
           Session::pull('basket.product'.$id, $id); 
        return  $id;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
       $news = \App\News::orderBy('id','desc')->limit(2)->get();
     
       return view('products.show',  compact('news','product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
