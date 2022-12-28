<?php

namespace Modules\Authorization\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Authorization\Repositories\V1\Permissions\PermissionRepository;
use Modules\Authorization\Repositories\V1\Permissions\PermissionRepositoryInterface;
use Modules\Authorization\Repositories\V1\Roles\RoleRepository;
use Modules\Authorization\Repositories\V1\Roles\RoleRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            RoleRepositoryInterface::class,
            RoleRepository::class
        );
        $this->app->bind(
            PermissionRepositoryInterface::class,
            PermissionRepository::class
        );
    }

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
