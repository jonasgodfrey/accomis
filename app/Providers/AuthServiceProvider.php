<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
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

        //full access rules
        Gate::define('admin_role', function ($user) {
            return $user->hasRole('Admin');
        });

        //full access rules
        Gate::define('me_role', function ($user) {
            return $user->hasRole('Me');
        });

        //Cbo role
        Gate::define('cbo_role', function ($user) {
            return $user->hasRole('Cbo');
        });

        //Spo role
        Gate::define('spo_role', function ($user) {
            return $user->hasRole('Spo');
        });

        //admin spo access
        Gate::define('admin_spo', function ($user) {
            return $user->hasAnyRoles([
                'Admin',
                 'Spo'
            ]);
        });

        //admin cbo access
        Gate::define('admin_cbo', function ($user) {
            return $user->hasAnyRoles(['Admin', 'Cbo']);
        });

         //admin cbo access
         Gate::define('spo_cbo', function ($user) {
            return $user->hasAnyRoles(['Spo', 'Cbo']);
        });

         //admin cbo access
         Gate::define('admin_spo_cbo_me', function ($user) {
            return $user->hasAnyRoles(['Admin','Spo', 'Cbo','Me']);
        });

         //admin spo and me access
         Gate::define('admin_spo_me', function ($user) {
            return $user->hasAnyRoles(['Admin','Spo', 'Me']);
        });

        //admin spo and me access
        Gate::define('admin_me', function ($user) {
            return $user->hasAnyRoles(['Admin', 'Me']);
        });
    }
}
 