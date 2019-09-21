<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\APIReturnService;

class APIReturnServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('APIReturnService', function(){
            return new APIReturnService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
