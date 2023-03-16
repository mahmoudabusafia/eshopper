<?php

namespace App\Providers;

use App\Models\Category;
use App\Repositories\Cart\DatabaseRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        $categories = Category::where('parent_id', null)->with('children')->get();
        $cart = new DatabaseRepository();
        view()->share([
            'categories' => $categories,
            'cart' => $cart,
        ]);
    }
}
