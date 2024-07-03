<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        //

        View::composer('*', function($view) {

            //category links used the home page
            $categoryLinks = Category::all();
            $view->with('categoryLinks', $categoryLinks);

             //for all products
             $products = Product::orderBy('created_at', 'desc')->paginate(10);
            $view->with('products', $products);

            if(Auth::user()){
                $userId = Auth::user()->id;
                $cartCount = Cart::where('userId', $userId)->count();
                $view->with('cartCount', $cartCount);
            }
        });
    }
}
