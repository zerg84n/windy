<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
class NewsController extends Controller
{
     
    public function index()
    {
  
        $all_news = \App\News::orderBy('id','desc')->paginate(4);
      
        return view('news.index',  ['all_news'=>$all_news]);
    }
    
    public function show(News $news)
    {
  
       
        return view('news.show', compact('news'));
    }
}
