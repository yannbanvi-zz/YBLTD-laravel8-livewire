<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("admin", function($user){
            return $user->hasRole("admin");
        });

        Gate::define("employe", function($user){
            return $user->hasRole("employe");
        });

        Gate::define("manager", function($user){
            return $user->hasRole("manager");
        });

        Gate::define("access-for", function($user, $roles){
            return $user->hasAnyRoles($roles);
        });
    }
}
