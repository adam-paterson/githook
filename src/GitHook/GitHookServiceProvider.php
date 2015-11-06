<?php

namespace GitHook;

use GitHook\Services\Hook\Configuration;
use GitHook\Services\Hook\Tasks;
use GitHook\Services\Pathfinder;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

// Define DS
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

class GitHookServiceProvider extends ServiceProvider
{
    public function register()
    {
        // ...
    }

    public function provides()
    {
        return ['githook'];
    }

    public function boot()
    {
        $this->bindPaths();
        $this->bindConsoleClasses();
    }

    public function bindPaths()
    {
        $this->app->singleton('githook.paths', function ($app) {
            return new Pathfinder($app);
        });

        $this->app->singleton('githook.hook', function ($app) {
            return new Configuration($app);
        });

        $this->app->singleton('githook.hook.tasks', function ($app) {
            return new Tasks($app);
        });

        $this->app['githook.hook']->bindPaths();
    }

    public function bindConsoleClasses()
    {
        $this->app->singleton('githook.console', function () {
            return new Console\Console(
                $this->app,
                new Dispatcher($this->app),
                GitHook::VERSION
            );
        });
    }
}
