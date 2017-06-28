<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use View;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\Http\Requests\Admin\StoreReviewsRequest;
use App\Review;

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
        $products = \App\Product::orderBy('id','desc')->paginate(6);
        $slider = \App\Models\Banner::all()->first();
        return view('products.main',  compact('news','slider','products'));
    }
       public function search(Request $request)
    {
  
        $news = \App\News::orderBy('id','desc')->limit(2)->get();
           if ($request->has('keyword')){
                 $keyword = $request->input('keyword');
                 $products = \App\Product::where('title','LIKE','%'.$keyword.'%')->paginate(6);
           }else{
               $keyword = '';
                $products = \App\Product::paginate(6);
           }
         
        return view('products.search',  compact('news','products','keyword'));
    }
     public function catalog(Request $request)
    {
            
        if ($request->has('category')){
           $category = \App\Category::find($request->input('category'));
           $properties = $category->properties;
           if ($category){
               $products = $category->products()->paginate(6);
           } else {
               $products = \App\Product::paginate(6);
           }
        }else{
            $category = null;
             $products = \App\Product::paginate(6);
            $properties = \App\Models\Catalog\Property::all();
        }
        
        
      
        return view('products.catalog',  compact('products','category','properties'));
    }
    
    
    public function filter(Request $request) {
        
       
        $products_query = $this->buildFilteredProducts($request);
        
      
        
        $products = $products_query->paginate(6);
       if ($products->count()>0){
              $view = View::make('products.partials.products',[
         'products' => $products,
         
             ])->render();
       } else {
           
           $view = "Подходящих товаров не найдено! Попробуйте изменить критерии фильтрации.";
       }
     
  
     return $view;
       
    }
    
     public function alias_filter(Request $request) {
         
         $properties = \App\Models\Catalog\Property::all();
         $new_request = [];
         $old_inputs = $request->except('page');
        $filter = '';
         $news = \App\News::orderBy('id','desc')->limit(2)->get();
         foreach($properties as $property){
             if ($request->has($property->alias)){
                $filter .=$property->title;
                  if ($property->getInputType() == 'number'){
                      $range = $request->input($property->alias);
                     if (is_array($range)){
                         
                            if (!isset($range['max'])){
                                $range['max'] = $property->getRange()->last()->value;
                            }
                             if (!isset($range['min'])){
                                $range['min'] = $property->getRange()->first()->value;
                            }
                      $new_request['property'][$property->id] = $range;
                       $filter .= ' ( '.$range['min'].' - '.$range['max'].'), ';
                    }else{
                        $filter .= ' - '.$request->input($property->alias).', ';
                        $new_request['property'][$property->id]['min']= $request->input($property->alias);
                        $new_request['property'][$property->id]['max']= $request->input($property->alias);
                    }
                }else if ($property->getInputType() == 'select'){
                    $variants = $property->variants()->where('value','LIKE','%'.$request->input($property->alias).'%')->get();
                    $new_request['property'][$property->id] = $variants->pluck('id')->toArray();
                     $filter .= ' - '.$request->input($property->alias).', ';
                }else{
                      $new_request['property'][$property->id][] = $request->input($property->alias);
                      $filter .= ' - '.$request->input($property->alias).', ';
                }
                
             }
         }
           $request->merge($new_request);  
           
        
            $products_query = $this->buildFilteredProducts($request);
            
      if ($request->has('category')){
           $category = \App\Category::find($request->input('category'));
           $products = $products_query->paginate(6);
        }else{
            $category = $category = \App\Category::first();
            $products = $category->products()->paginate(6);
        }
       
       $products = $products->appends($old_inputs);
           return view('products.alias',  compact('products','news','category','filter'));
     }
    
    public function buildFilteredProducts(Request $request){
        //$input_array - $ia
        $ia = $request->all();
        
        if ($request->has('category')){
            $products_query = Product::where('category_id',$request->input('category'));
        }else{
            $products_query = Product::select();
        }
        if ($request->has('price_original')){
             $products_query = $products_query->whereBetween('price_original', [$ia['price_original']['min'], $ia['price_original']['max']]);
        }
        if ($request->has('popular')){
           $products_query = $products_query->where('popular','=',1); 
        }
        if ($request->has('property')){
            
            foreach($ia['property'] as $property_id => $value ){
                
                $property = \App\Models\Catalog\Property::find($property_id);
                
                if ($property->getInputType() == 'number'){
                    
                    $Model = $property->value_type;
                    $ids = $Model::where('property_id',$property->id)->whereBetween('value',[$value['min'],$value['max']])->get()->pluck('product_id')->toArray();
                    $products_query = $products_query->whereIn('id',$ids);
                }else{
                    $Model = $property->value_type;
                    $ids = $Model::where('property_id',$property->id)->whereIn('value',$value)->get()->pluck('product_id')->toArray();
                    $products_query = $products_query->whereIn('id',$ids);
                }
              
            }
        }
          if ($request->has('sort')){
            $products_query = $products_query->orderBy('price_original',$request->input('sort'));
        }
        return $products_query;
        
    }
    
    
      public function compare_add(Request $request)
    {
          
          $id = $request->input('id');
         $category_id = Product::find($id)->category_id;
           Session::put('compare.'.$id, $category_id); 
        return  count(Session::get('compare',[]));
    }
      public function compare_del(Request $request)
    {
          $id = $request->input('id');
           Session::pull('compare.'.$id); 
        return  count(Session::get('compare',[]));
    }
    public function compare(){
         $compare = Session::get('compare',[]);
         $products = collect();
          if (count($compare)){
             foreach ($compare as $id=>$category){
                 $product = \App\Product::find($id);
                 if ($product) $products->push($product);
                 
             }
         }
        $news = \App\News::orderBy('id','desc')->limit(2)->get();
      
        $cat_ids = $products->keyBy('category_id')->keys();
        $categories = \App\Category::whereIn('id',$cat_ids)->get();
      
        return view('products.compare',  compact('news','products','categories'));
        
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
    public function review(StoreReviewsRequest $request)
    {
      
        $review = Review::create($request->all());

        Session::put('review.'.$request->input('product_id'),1);

        return back()->withSuccess('Спасибо за ваш отзыв! Он появится здесь после проверки модератором.');
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
