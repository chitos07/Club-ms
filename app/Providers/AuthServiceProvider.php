<?php

namespace App\Providers;

use App\Models\Role;
use http\Client\Curl\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * RegisterRequest any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (!$this->app->routesAreCached()) {
            Passport::routes();
           Passport::personalAccessClient('Qwy4Y5y5nmYLtXQqRdr9KZHSTyNaQdvfSC9AwoyX');


        }
        // get All Roles From role Table
       Passport::tokensCan(Role::getRoles());
    }
}
