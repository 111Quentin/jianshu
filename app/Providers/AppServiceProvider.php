<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        \View::composer('layout.nav',function ($view){
            $user=\Auth::user();
            $view->with('user',$user);
        });

         \View::composer('layout.sizebar',function ($view){
                $topics=\App\Topic::all();
                $view->with('topics',$topics);
         });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
