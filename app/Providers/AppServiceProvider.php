<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        if (Schema::hasTable('permissions')) {
            Permission::all()->each(function ($permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    return $user->hasAccess($permission->name);
                });
            });
        }
    }
}
