<?php

namespace App\Providers;

use Illuminate\Auth\AuthManager;
use Illuminate\Auth\TokenGuard;
use Illuminate\Support\Facades\Auth;
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
        if (app()->isLocal()) {
            $this->app->register(\VIACreative\SudoSu\ServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        Auth::extend('web-token', function ($app, $name, $config) {
             $guard = new TokenGuard(

               Auth::createUserProvider($config['provider'] ?? null),
                $app['request'],
                'token',
                'token'
            );

            $app->refresh('request', $guard, 'setRequest');
            return $guard;
        });

        //
    }


}
