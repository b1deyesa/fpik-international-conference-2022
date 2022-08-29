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
        # (1)General                   |
        # (2)Student                   |
        # (3)Researcher                |
        # (4)Lecturers                 |
        # (5)Presenter - Domestic      |
        # (6)Presenter - International |
        # ------------------------------

        # --------- User Role ----------
        #                              |
        # (1)Guest                     |
        # (2)Admin                     |
        # (3)Superadmin                |
        # ------------------------------
        
        Gate::define('user-payment', function (User $user) {
            return $user->status->id === 5 || 
                   $user->status->id === 6 ;
        });

        Gate::define('user-article', function (User $user) {
            return 
                   $user->status->id  == 3 || 
                   $user->status->id  == 4;
        });

        Gate::define('admin', function (User $user) {
            return $user->role->id == 2 ;
        });

    }
}
