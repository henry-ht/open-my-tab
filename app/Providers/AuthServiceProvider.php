<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
     */
    public function boot(): void
    {
        /* define a AppAdmin user role */
        Gate::define('is_admin', function($user) {
            return $user->role === 'admin_app';
        });

        /* define a user_app user role */
        Gate::define('is_user', function($user) {
            return $user->role === 'user_app';
        });
    }
}
