<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        # -------- User Status ---------
        #                              |
        # (1)Domestic Participant      |
        # (2)Domestic Student          |
        # (3)Foreign Participant       |
        # (4)Foreign Student           |
        # ------------------------------

        # --------- User Role ----------
        #                              |
        # (1)Guest                     |
        # (2)Admin                     |
        # (3)Superadmin                |
        # ------------------------------
        
        Gate::define('user-payment', function (User $user) {
            return 
                   $user->status->id === 1 || 
                   $user->status->id === 3 ||
                   $user->status->id === 4 ;
        });

        Gate::define('user-article', function (User $user) {
            return 
                   $user->status->id  == 1 || 
                   $user->status->id  == 2 || 
                   $user->status->id  == 3 || 
                   $user->status->id  == 4;
        });

        Gate::define('admin', function (User $user) {
            return $user->role->id == 2;
        });

    }
}
