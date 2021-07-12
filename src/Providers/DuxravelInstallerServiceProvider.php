<?php

namespace duxphp\DuxravelInstaller\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use duxphp\DuxravelInstaller\Middleware\canInstall;
use duxphp\DuxravelInstaller\Middleware\canUpdate;

class DuxravelInstallerServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/installer.php', 'installer');
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
    }

    /**
     * Bootstrap the application events.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        $router->middlewareGroup('install', [CanInstall::class]);
        $router->middlewareGroup('update', [CanUpdate::class]);

        $this->loadTranslationsFrom(__DIR__.'/../Lang', 'installer_messages');
    }
}
