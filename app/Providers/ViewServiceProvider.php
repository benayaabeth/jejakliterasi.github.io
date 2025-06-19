<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Book;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer(['layouts.user'], function ($view) {
            $cartCount = session()->has('cart') ? count(session('cart')) : 0;
            $view->with('cartCount', $cartCount);
        });
    }
}