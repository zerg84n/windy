<?php

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Request;

class CeoComposer
{
  /**
   * Реализация пользовательского репозитория.
   *
   * @var UserRepository
   */
  protected $users;

  /**
   * Создание построителя нового профиля.
   *
   * @param  UserRepository  $users
   * @return void
   */
  public function __construct()
  {
  
  }

  /**
   * Привязка данных к представлению.
   *
   * @param  View  $view
   * @return void
   */
  public function compose(View $view)
  {
      //Main page exception
      if (Request::path()=='/'){
          $path = Request::path();
      }else {
          $path = '/'.Request::path();
      }
      
      
      $item = \App\Item::where('url',$path)->first();
      
      $title = $item?$item->ceo_title:null;
      $description = $item?$item->ceo_description:null;
      $ceo_head_text = $item?$item->ceo_head_text:null;
      $ceo_foot_text  = $item?$item->ceo_foot_text:null;  
    
    $view->with([
        'ceo_title'=>$title, 
        'ceo_description'=>$description,
        'ceo_head_text'=>$ceo_head_text,
        'ceo_foot_text'=>$ceo_foot_text ] );
  }
}

