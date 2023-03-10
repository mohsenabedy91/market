<?php

namespace Modules\Authorization\Providers;

use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\Authorization\Models\Permission;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        try {
            Permission::all()->map(function (Permission $permission) {
                Gate::define($permission->name, static function ($user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            });
        } catch (Exception $e) {
            return;
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }
}
