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
        // 1. Acceso técnico/infraestructura total (Informática y Administrador)
        Gate::define('access-full-ti', function (User $user) {
            return in-array($user->role_slug, ['informatica', 'administrador']);
        });

        // 2. Acceso operativo exclusivo para capacitación
        Gate::define('access-ensenanza', function (User $user) {
            return $user->role_slug === 'ensenanza';
        });
    }
}
