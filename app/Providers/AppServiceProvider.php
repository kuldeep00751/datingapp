<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
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
        // // Set the locale based on session value, default to 'en'
        // $locale = Session::get('locale', 'en');
        // App::setLocale($locale);

        if ($this->app->runningInConsole()) {
            App::setLocale('es');
        } else {
            $locale = Session::get('locale', 'en');
            App::setLocale($locale);
        }
    }
}
