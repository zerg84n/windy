<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use Session;
use App\Http\Requests\Front\StoreOrderRequest;
class CartController extends Controller
{
      use FileUploadTrait;
     public function index()
    {
         $cart = Session::get('cart',[]);
         $products = collect();
         if (count($cart)){
             foreach ($cart as $id=>$count){
                 $product = \App\Product::find($id);
                 if ($product) $products->push($product);
                 
             }
         }
        $news = \App\News::orderBy('id','desc')->limit(2)->get();
     
       
        return view('products.cart',  compact('news','products','cart'));
    }
    
    
    public function store (StoreOrderRequest $request){
        
     
        $request = $this->saveFiles($request);
         $order = \App\Order::create($request->except('product_count','_token') );
        $order_product =  $request->input('product_count');
        foreach($order_product as $id=>$count){
            $product = \App\Product::find($id);
            if ($product) $order->products()->save($product,['count'=>$count]);
        }
        
        
         Session::pull('cart'); 

        return redirect()->route('products-index')->withSuccess('Ваш заказ принят! Ожидайте звонка.');
        
    }

    

    public function cart_add(Request $request)
    {
          $result = array();
          $id = $request->input('id');
         
          $count = $request->has('count')?$request->input('count'):1;
           Session::put('cart.'.$id, $count); 
           $result['id']=$id;
           $result['cart_size'] =  count(Session::get('cart',[]));
        return $result;
    }
      public function cart_del(Request $request)
    {
          $result = array();
          $id = $request->input('id');
        
           Session::pull('cart.'.$id); 
           $result['id']=$id;
           $result['cart_size'] =  count(Session::get('cart',[]));
        return $result;
          
      
    }
}
