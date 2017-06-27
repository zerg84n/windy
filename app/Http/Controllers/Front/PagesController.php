<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
     public function page($alias)
    {
       
        $page = \App\Models\Page::where('alias',$alias)->get()->first();
         if ($page){
             return view('pages.show',  compact('page'));
         } else {
              return view('errors.404');
         }
        
    }
}
