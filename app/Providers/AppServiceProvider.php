<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;

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
        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });

        // Ambil semua permission dari table permissions
        foreach (Permission::all() as $permission) {
            Gate::define($permission->name, function ($user) use ($permission) {
                // Cek apakah user punya permission ini
                return $user->hasPermissionTo($permission->name);
            });
        }
     }
 }
