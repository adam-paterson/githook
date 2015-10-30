<?php
namespace GitHook;

use GitHook\Console\Console;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

class GitHookServiceProvider extends ServiceProvider
{
    public function register()
    {
        return true;
    }

    public function boot()
    {
        $this->bindConsoleClasses();
    }

    public function provides()
    {
        return ['githook'];
    }

    public function bindConsoleClasses()
    {
        $this->app->singleton('githook.console', function() {
            return new Console($this->app, new Dispatcher(), GitHook::VERSION);
        });
    }

}