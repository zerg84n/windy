<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
class ComposerServiceProvider extends ServiceProvider
{
  /**
   * Регистрация привязок в контейнере.
   *
   * @return void
   */
  public function boot()
  {

           
           
    View::composer(
      ['products.alias','products.main','pages.show'], 'App\Http\ViewComposers\CeoComposer'
    );

    // Использование построителей на основе замыканий...
    View::composer('products.show', function ($view) {
        $product = Route::current()->parameters['product'];
       
        if ($product){
             $title = $product->title." купить недорого.";
            $description = $product->title." купить в интернет-магазине Windytech оптом и в розницу.";
            $ceo_head_text = null;
            $ceo_foot_text  = null; 
        }else{
            $title = null;
            $description = null;
            $ceo_head_text = null;
            $ceo_foot_text  = null; 
        }
        
         $view->with([
        'ceo_title'=>$title, 
        'ceo_description'=>$description,
        'ceo_head_text'=>$ceo_head_text,
        'ceo_foot_text'=>$ceo_foot_text ] );
      
        
      //
    });
  }

  /**
   * Регистрация сервис-провайдера.
   *
   * @return void
   */
  public function register()
  {
    //
  }
}
