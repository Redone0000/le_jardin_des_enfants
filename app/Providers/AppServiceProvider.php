<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('access-admin', function (User $user) {
            return $user->role_id === 1;
        });
        Gate::define('access-teacher', function (User $user) {
            return $user->role_id === 2;
        });
        Gate::define('access-parent', function (User $user) {
            return $user->role_id === 3;
        });
        Gate::define('access-admin-teacher', function (User $user) {
            return $user->role_id === 1 || $user->role_id === 2;
        });

        Gate::define('access-dashboard', function (User $user) {
            return $user->role_id === 3 || $user->role_id === 2 || $user->role_id === 1;
        });
    }
}
