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
    private $filter = '';
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
                 $products = \App\Product::orderBy('id','desc')
                         ->where('title','LIKE','%'.$keyword.'%')
                         ->orWhere('articul','LIKE','%'.$keyword.'%')
                         ->paginate(51);
           }else{
               $keyword = '';
                $products = \App\Product::orderBy('id','desc')->paginate(51);
           }
         
        return view('products.search',  compact('news','products','keyword'));
    }
     public function catalog(Request $request)
    {
            
        if ($request->has('category')){
           $category = \App\Category::find($request->input('category'));
           $properties = $category->properties;
           if ($category){
               $products = $category->getHitFirst()->paginate(51);
           } else {
               $products = \App\Product::orderBy('id','desc')->paginate(51);
           }
        }else{
            $category = null;
             $products = \App\Product::paginate(50);
            $properties = \App\Models\Catalog\Property::all();
        }
        
        
      
        return view('products.catalog',  compact('products','category','properties'));
    }
    
    
    public function filter(Request $request) {
        
       
        $products_query = $this->buildFilteredProducts($request);
        
      
        
        $products = $products_query->paginate(51);
       if ($products->count()>0){
              $view = View::make('products.partials.products',[
         'products' => $products,
         
             ])->render();
       } else {
           
           $view = "Подходящих товаров не найдено! Попробуйте изменить критерии фильтрации.";
       }
     
  
     return $view;
       
    }
    private function get_brands($brands_titles_array) {
        $brands =[];
           if (count($brands_titles_array)>0){
                    
                    foreach($brands_titles_array as $brand_title){
                        $brand = \App\Brand::whereSlug($brand_title)->first();
                        if($brand){
                           
                            $brands[]= $brand->id;
                        }
                    }
                   
                }
                 return $brands;
    }
    public function human_filter(Request $request, $category_slug=null, $brand_list = null,$custom_slug=null) {
       
          $new_request = [];
          $has_brands = false;
      
        if($category_slug){
            if($brand_list){
                 $brands_titles_array=  explode('&', $brand_list);
                 $brands =$this->get_brands($brands_titles_array);
             
                    if($brands){
                        $has_brands = true;
                        $new_request['brand_id']=$brands;
                        
                       if ($custom_slug){
                     
                            //$new_request['slug']=$custom_slug;
                            $filter = \App\Filter::whereSlug($custom_slug)->first();
                            if($filter){
//                                $parts = explode('&', $filter->query);
//                                foreach ($parts as $part){
//                                    $query = explode('=', $part);
//                                    $new_request[$query[0]] = $query[1];
//                                }
                             parse_str($filter->query, $inputs_array);
                             
                             $request->merge($inputs_array);
                            }
                        }    
                    } else {
                        
                       
                            $filter = \App\Filter::whereSlug($brand_list)->first();
                            if($filter){
//                                $parts = explode('&', $filter->query);
//                                foreach ($parts as $part){
//                                    $query = explode('=', $part);
//                                    $new_request[$query[0]] = $query[1];
//                                }
                             parse_str($filter->query, $inputs_array);
                             
                             $request->merge($inputs_array);
                            }
                    }
                 
              
                
            } 
            $category = \App\Category::whereSlug($category_slug)->first();
           
            if ($category){
                $new_request['category']=$category->id;
               
            } else {
                $brands_titles_array=  explode('&', $category_slug);
              
                $brands = $this->get_brands($brands_titles_array);
             
               if($brands){
                   $new_request['brand_id']=$brands;
               } else {
                   
                  
                  $filter = \App\Filter::whereSlug($category_slug)->first();
                            if($filter){
//                                $parts = explode('&', $filter->query);
//                                foreach ($parts as $part){
//                                    $query = explode('=', $part);
//                                    $new_request[$query[0]] = $query[1];
//                                }
                             parse_str($filter->query, $inputs_array);
                             
                             $request->merge($inputs_array);
                            }
               }
            }
        } else {
        
        }
        //dd($new_request);
         $request->merge($new_request);  
         $translated_inputs = $this->translate_human_request($request);
         $request->merge($translated_inputs);  
         $products_query = $this->buildFilteredProducts($request);
        
      if ($request->has('category')){
           $category = \App\Category::find($request->input('category'));
           $products = $products_query->orderBy('popular','desc')->paginate(51);
           
             
        }else{
            $category = $category = \App\Category::first();
            $products = $category->getHitFirst()->paginate(51);
        }
        $brands = $category->getBrands();
         $properties = $category->properties;
        if ($request->has('popular')){
            if ($request->input('popular')==1){
                 $this->filter .= 'Популярные ';
            }
            
        }
       $filter = $this->filter;
       //$products = $products->appends($old_inputs);
       //$products->setPath($request->path());
       $old_inputs = $request->all();
     if ($has_brands){
          $brand_list = collect(explode('&', $brand_list));
     }else{
         $brand_list = collect();
     }
       
      
           return view('products.alias',  compact('products','properties','category','brands','filter','old_inputs','brand_list'));
       
       //$products_query = $this->buildFilteredProducts($request);
      // dd($request->all());
       // dd( $products_query->get());
      // return $this->alias_filter($request);
         
    }
    
    public function redirect_to_human_url(Request $request) {
        
      //  dd($request->all());
        if ($request->has('category')){
            $category = \App\Category::find($request->input('category'))->first();
            $category_slug = $category->slug;
        }  else {
            $category_slug = null;
        }
        if ($request->has('brand_id')){
            $brand_ids = $request->input('brand_id');
            $brands_slugs = \App\Brand::whereIn('id',$brand_ids)->get()->pluck('slug')->toArray();
            $brand_list = implode('&', $brands_slugs);
           
        } else {
            $brand_list = null;
        }
      $clean_input = $request->except(['brand_id','category','_token']);
    $request->replace($clean_input);
     
    return $this->human_filter($request, $category_slug, $brand_list);
       //return redirect()->route('products-catalog-human', ['category_slug'=>$category_slug,'brand_list'=>$brand_list]);
        
        }
    
    public function translate_human_request(Request $request) {
        $properties = \App\Models\Catalog\Property::all();
        $new_request = [];
       // dd($request->all());
         foreach($properties as $property){
             if ($request->has($property->alias)){
                $this->filter .=$property->title.'-';
                  if ($property->getInputType() == 'number' || $property->getInputType() == 'float' ){
                      $range = $request->input($property->alias);
                     if (is_array($range)){
                         
                            if (!isset($range['max'])){
                                $range['max'] = $property->getRange()->last()->value;
                            }
                             if (!isset($range['min'])){
                                $range['min'] = $property->getRange()->first()->value;
                            }
                      $new_request['property'][$property->id] = $range;
                        $this->filter .= ' ( '.$range['min'].' - '.$range['max'].'), ';
                    }else{
                         $this->filter .= $request->input($property->alias).', ';
                        $new_request['property'][$property->id]['min']= $request->input($property->alias);
                        $new_request['property'][$property->id]['max']= $request->input($property->alias);
                    }
                }else if ($property->getInputType() == 'select'){
                    $select = [];
                    if (!is_array($request->input($property->alias))){
                        
                        $select[] = $request->input($property->alias);
                    } else {
                        $select = $request->input($property->alias);
                    }
                    $variants = $property->variants()->whereIn('value',$select)->get();
                 
                    //'LIKE','%'.$request->input($property->alias).'%')->get();
                    $new_request['property'][$property->id] = $variants->pluck('id')->toArray();
                   
                      $this->filter .= implode(',', $variants->pluck('value')->toArray()).', ';
                }else{
                      $new_request['property'][$property->id][] = $request->input($property->alias);
                      $result = '';
                      foreach ($request->input($property->alias) as $value) {
                          if ($value == 1){
                              $result.='да, ';
                          }else{
                               $result.='нет, ';
                          }
                      }
                      // $this->filter .= implode(',', $request->input($property->alias)).', ';
                      $this->filter .=$result;
                }
                
             }
         }
        return $new_request;
        
    }
     public function alias_filter(Request $request) {
         
         $properties = \App\Models\Catalog\Property::all();
       
         $old_inputs = $request->except('page');
       
         $news = \App\News::orderBy('id','desc')->limit(2)->get();
           $new_request = $this->translate_human_request($request);
        
           $request->merge($new_request);  
           
        
            $products_query = $this->buildFilteredProducts($request);
        
      if ($request->has('category')){
           $category = \App\Category::find($request->input('category'));
           $products = $products_query->paginate(51);
            
        }else{
            $category = $category = \App\Category::first();
            $products = $category->products()->paginate(51);
        }
        $brands = $category->getBrands();
         $properties = $category->properties;
        if ($request->has('popular')){
               if ($request->input('popular')==1){
                 $this->filter .= 'Популярные ';
            }
        }
       $filter = $this->filter;
       $products = $products->appends($old_inputs);
       //$products->setPath($request->path());
           return view('products.alias',  compact('products','properties','news','category','brands','filter'));
     }
    
    public function buildFilteredProducts(Request $request){
        //$input_array - $ia
        $ia = $request->all();
        
        if ($request->has('category')){
            $products_query = Product::where('category_id',$request->input('category'));
        }else{
            $products_query = Product::select();
        }
        
         if ($request->has('brand_id')){
            $products_query = $products_query->whereIn('brand_id',$request->input('brand_id'));
        }
       
        if ($request->has('price_original')){
             $products_query = $products_query->whereBetween('price_original', [$ia['price_original']['min'], $ia['price_original']['max']]);
        }
          
        if ($request->has('popular')&&$request->input('popular')==1){
            
           $products_query = $products_query->where('popular','=',1); 
        }
       
        if ($request->has('property')){
            
            foreach($ia['property'] as $property_id => $value ){
               
                $property = \App\Models\Catalog\Property::find($property_id);
                
                if ($property && ($property->getInputType() == 'number' || $property->getInputType() == 'float')){
                    
                    $Model = $property->value_type;
                    $ids = $Model::where('property_id',$property->id)
                            ->whereBetween('value',[$value['min'],$value['max']])
                            ->orWhere('value',null)
                            ->get()
                            ->pluck('product_id')
                            ->toArray();
                    //Empty properties problem bicycle
                    $tmp = clone $products_query;
                    $has_ids = $Model::where('category_id',$request->input('category'))->where('property_id',$property->id)->get()->pluck('product_id')->toArray();
                    $empty_ids = $tmp
                           ->whereNotIn('id',$has_ids)
                            ->get()
                            ->pluck('id')
                            ->toArray();
        
                   $ids = array_merge ($ids,$empty_ids);
                      
                    //end bicycle
                         
                  
                     
                    $products_query = $products_query->whereIn('id',$ids);
                }else{
                    $Model = $property->value_type;
                    $ids = $Model::where('property_id',$property->id)
                            ->whereIn('value',$value)
                         //   ->orWhere('value',null)
                            ->get()
                            ->pluck('product_id')
                            ->toArray();
                    
                  
                     //Empty properties problem bicycle
                    $tmp = clone $products_query;
                    $has_ids = $Model::where('category_id',$request->input('category'))->where('property_id',$property->id)->get()->pluck('product_id')->toArray();
                    $empty_ids = $tmp
                           ->whereNotIn('id',$has_ids)
                            ->get()
                            ->pluck('id')
                            ->toArray();
        
                   $ids = array_merge ($ids,$empty_ids);
                      
                    //end bicycle
                     
                    $products_query = $products_query->whereIn('id',$ids);
                }
              
            }
        }
          if ($request->has('sort')){
            $products_query = $products_query->orderBy('price_original',$request->input('sort'));
          
        } else {
            
            $products_query = $products_query;
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
