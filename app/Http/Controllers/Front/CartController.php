<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use Session;
use Log;
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
        
        if ($order->payment_type == "Картой"){
             return view('pages.payment-start',  compact('order'));
        } else {
            Session::pull('cart'); 
            return redirect()->route('products-index')->withSuccess('Ваш заказ принят. Менеджер свяжется с вами.');
        }
         

       
        
    }
    
       public function result(Request $request) {
        $answer = "";
        foreach ($request->all() as $key=>$input){
            $answer.=$key.":".$input.",";
        }
         Log::info("Answer from robokassa: ".$answer);
       // dd($request->all());
        
         if($request->has("InvId")){
             $InvId= $request->input("InvId");
             $order = \App\Order::find((int)$InvId);
            
             
             $OutSum = $request->input("OutSum");
             $pass2 = "xRTRiEL34IO6UyT67ieA";
              if ($request->has('SignatureValue')){
                    $SignatureValue_remote = $request->input('SignatureValue');
                    $SignatureValue_local = mb_strtoupper(md5("$OutSum:$InvId:$pass2"));
                    if ($SignatureValue_remote == $SignatureValue_local ){
                        if ($order){
                           
                            $order->payment_type = $request->input("IncCurrLabel");
                            $order->setSuccessStatus();
                            $order->save();
                            
                        }

                         return "OK".$InvId;
                    }else{
                         if ($order)
                        $order->setFailStatus();
                        return "ERROR"; 
                    }
                    
               }
            
         }else{
             return "ERROR";
         }
       
    }
    
      public function success(Request $request) {
        // Log::info(print_r($request->all()));
           $InvId= $request->input("InvId");
           
         
             $OutSum = $request->input("OutSum");
            
             $pass1 = "llS52FX32hxB4SqrDnRo";
             $SignatureValue_remote = $request->input('SignatureValue');
            $SignatureValue_local = md5("$OutSum:$InvId:$pass1");
            
           $order = \App\Order::find($InvId);
           if ($order){
               if(!$order->isSuccess()){
               
               $order->payment_type = $request->input("IncCurrLabel");
                
               $order->save();
               
               }
         Session::pull('cart'); 
         return view('pages.payment-success');
         }
         return redirect()->route('payment-fail',$request->all());
    }
    
      public function fail(Request $request) {
        // Log::info(print_r($request->all()));
       // dd($request->all());
          $InvId= $request->input("InvId");
           $order = \App\Order::find($InvId);
           if ($order){
               if(!$order->isSuccess()){
               $order->setFailStatus();
                $order->payment_method = $request->input("IncCurrLabel");
                
               $order->save();
               
               }
           }
          return view('pages.payment-fail');
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
