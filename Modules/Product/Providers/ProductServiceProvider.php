<?php

namespace Modules\Product\Providers;

use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected string $moduleName = "Product";

    /**
     * @var string $moduleNameLower
     */
    protected string $moduleNameLower = "product";

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->loadMigrationsFrom(module_path($this->moduleName, "Database/Migrations"));
        $this->resolveRelationUsing();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
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
     *
     * @return void
     */
    private function resolveRelationUsing(): void
    {
        //
    }
}