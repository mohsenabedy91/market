<?php

namespace Modules\Authorization\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Modules\Authorization\Http\Middleware\RoleMiddleware;
use Modules\Authorization\Models\Permission;
use Modules\Authorization\Models\Role;
use Modules\User\Models\User;

class AuthorizationServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected string $moduleName = "Authorization";

    /**
     * @var string $moduleNameLower
     */
    protected string $moduleNameLower = "authorization";

    /**
     * Boot the application events.
     *
     * @param Router $router
     * @return void
     */
    public function boot(Router $router): void
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->loadMigrationsFrom(module_path($this->moduleName, "Database/Migrations"));
        $this->resolveRelationUsing();

        $router->aliasMiddleware('role', RoleMiddleware::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(PermissionServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig(): void
    {
        $this->publishes([
            module_path($this->moduleName, "Config/config.php") => config_path($this->moduleNameLower . ".php"),
        ], "config");
        $this->mergeConfigFrom(
            module_path($this->moduleName, "Config/config.php"), $this->moduleNameLower
        );
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path("lang/modules/" . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, "Resources/lang"), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, "Resources/lang"));
        }
    }

    /**
     * @return void
     */
    private function resolveRelationUsing(): void
    {
        Role::resolveRelationUsing("user", static function (Role $role) {
            return $role->belongsTo(User::class, "user_id", "id");
        });
        Role::resolveRelationUsing("created_by", static function (Role $role) {
            return $role->belongsTo(User::class, "created_by", "id");
        });
        Role::resolveRelationUsing("updated_by", static function (Role $role) {
            return $role->belongsTo(User::class, "updated_by", "id");
        });

        Permission::resolveRelationUsing("user", static function (Permission $permission) {
            return $permission->belongsTo(User::class, "user_id", "id");
        });
        Permission::resolveRelationUsing("created_by", static function (Permission $permission) {
            return $permission->belongsTo(User::class, "created_by", "id");
        });
        Permission::resolveRelationUsing("updated_by", static function (Permission $permission) {
            return $permission->belongsTo(User::class, "updated_by", "id");
        });
    }
}
