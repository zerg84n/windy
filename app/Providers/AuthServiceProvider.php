<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        
        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Products
        Gate::define('product_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('product_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('product_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('product_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('product_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Category
        Gate::define('category_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('category_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('category_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('category_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('category_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Specification
        Gate::define('specification_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('specification_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('specification_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('specification_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('specification_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });
		
		 // Auth gates for: Menu
        Gate::define('menu_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('menu_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('menu_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('menu_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Item
        Gate::define('item_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('item_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('item_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('item_delete', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

        // Auth gates for: News
        Gate::define('news_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('news_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('news_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('news_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('news_delete', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        
          // Auth gates for: Pages
        Gate::define('page_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('page_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('page_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('page_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('page_delete', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        
           // Auth gates for: Pages
        Gate::define('banners_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('banners_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('banners_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('banners_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('banners_delete', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        
         // Auth gates for: Reviews
        Gate::define('review_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('review_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('review_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('review_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('review_delete', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

    }
}
