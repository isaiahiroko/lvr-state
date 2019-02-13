<?php

namespace Isaiahiroko\LvrState;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class Provider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\Isaiahiroko\LvrState\State::class, function($app){
            return new \Isaiahiroko\LvrState\State();
        });

        View::share('state', resolve('Isaiahiroko\LvrState\State'));
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
