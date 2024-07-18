<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('admin', function(User $user) {
            return $user->role === 'admin';
        });

        Gate::define('guru', function(User $user) {
            return $user->role === 'guru';
        });

        Gate::define('kepsek', function(User $user) {
            return $user->role === 'kepsek';
        });
        
        Gate::define('siswa', function(User $user) {
            return $user->role === 'siswa';
        });

        Gate::define('navbar-access', function ($user) {
            return in_array($user->role, ['guru', 'siswa', 'kepsek']);
        });
    }
}
