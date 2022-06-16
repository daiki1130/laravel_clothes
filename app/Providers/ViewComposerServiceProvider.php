<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Auth;
use App\User;
use App\Category;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view) {
            $view->with('login_user', Auth::user());
            
            if(empty(Auth::user())){
                $view->with('recommended_users',User::inRandomOrder()->limit(3)->get());
            }else{
                $view->with('recommended_users',User::recommend(Auth::user()->id)->get());
            }
            
            $view->with('men_categories',Category::where('category_gender','men')->get());
            $view->with('women_categories',Category::where('category_gender','women')->get());
        });
    }
}
