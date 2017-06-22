<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mailers\AppMailer;
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
}
