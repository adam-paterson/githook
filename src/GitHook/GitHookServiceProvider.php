<?php
namespace GitHook;

use GitHook\Console\Console;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

/**
 * Class GitHookServiceProvider
 * @author Adam Paterson <hello@adampaterson.co.uk>
 *
 * @package GitHook
 */
class GitHookServiceProvider extends ServiceProvider
{
    /**
     * @return bool
     */
    public function register()
    {
        return true;
    }

    /**
     * Run binding methods and any setup
     */
    public function boot()
    {
        $this->bindConsoleClasses();
    }

    /**
     * Provides identity
     *
     * @return array
     */
    public function provides()
    {
        return ['githook'];
    }

    /**
     * Bind console classes for access through application facade
     */
    public function bindConsoleClasses()
    {
        $this->app->singleton('githook.console', function () {
            return new Console($this->app, new Dispatcher(), GitHook::VERSION);
        });
    }
}
