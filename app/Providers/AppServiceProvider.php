<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\TopicObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Topic::observe(\App\Observers\TopicObserver::class);
        \Carbon\Carbon::setLocale('zh-TW');
        
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
