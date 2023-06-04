<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Extensions\MongodbUserProvider;
use App\Guards\MongodbGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // add custom guard provider
        Auth::provider('mongo_provider', function ($app, array $config) {
            return new MongodbUserProvider($app->make('App\Models\Mongodb\User'));
        });
    
        // add custom guard
        Auth::extend('mongo_guard', function ($app, $name, array $config) {
            return new MongodbGuard(Auth::createUserProvider($config['provider']), $app->make('request'));
        });
    }
}
