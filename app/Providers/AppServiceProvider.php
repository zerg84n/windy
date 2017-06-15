<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $main_menu = \App\Menu::find(1);
        $top_menu = \App\Menu::find(3);
        
        Schema::defaultStringLength(191);
     
        View::share('main_menu', $main_menu);
        View::share('top_menu', $top_menu);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        /**
         * Added missing method for package to work
         */
        \Illuminate\Support\Collection::macro('lists', function ($a, $b = null) {
            return collect($this->items)->pluck($a, $b);
        });

    }
}
