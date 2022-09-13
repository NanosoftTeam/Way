<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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

        Gate::define('isAdmin', function(User $user){
            return $user->role >= 4;
        });

        Gate::define('isIT_p', function(User $user){
            return $user->role >= 3;
        });

        Gate::define('isIT', function(User $user){
            return $user->role >= 2;
        });

        Gate::define('isReader', function(User $user){
            return $user->role >= 1;
        });
        
        Gate::define('isBlocked', function(User $user){
            return $user->role == 0;
        });
    }
}
