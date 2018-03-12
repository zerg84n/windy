<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mailers\AppMailer;
use Session;

class MailController extends Controller
{
    public function call_order(Request $request) {
        
       // dd($request->all());
        
        $name = $request->input('name');
        $phone = $request->input('phone');
        
         $mailer = new AppMailer();
              
       $mailer->orderCall($name, $phone);
       
       return 'suxx';
    }
    
      public function exist_order(Request $request) {
        
       // dd($request->all());
        
        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $product_id = (int) $request->input('product_id');
        $product = \App\Product::find($product_id);
        $mailer = new AppMailer();
        
              
       $mailer->existCall($name, $phone,$email,$product);
       
       if(!empty($email)){
           $mailer->exist_clientNotify($name,$email,$product); 
       } 
       
       Session::put('exist.'.$product_id, 1); 
       return 'suxx';
    }
    
  
    
    
}
