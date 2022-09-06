<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(
            'App\Http\Interfaces\AdminInterface',
            'App\Http\Repositories\AdminRepo'
        );

        $this->app->bind(
            'App\Http\Interfaces\UserInterface',
            'App\Http\Repositories\UserRepo'
        );
        $this->app->bind(
            'App\Http\Interfaces\AuthInterface',
            'App\Http\Repositories\AuthRepo'
        );
        
        $this->app->bind(
            'App\Http\Interfaces\CategoryInterface',
            'App\Http\Repositories\CategoryRepo'
        );
        $this->app->bind(
            'App\Http\Interfaces\ProductInterface',
            'App\Http\Repositories\ProductRepo'
        );
        $this->app->bind(
            'App\Http\Interfaces\ClientInterface',
            'App\Http\Repositories\ClientRepo'
        );
        $this->app->bind(
            'App\Http\Interfaces\OrderInterface',
            'App\Http\Repositories\OrderRepo'
        );
        $this->app->bind(
            'App\Http\Interfaces\test',
            'App\Http\Repositories\test'
        );

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    //test Uploading
    public function boot()
    {


    }
}
