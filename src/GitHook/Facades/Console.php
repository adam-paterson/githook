<?php

namespace GitHook\Facades;

use GitHook\GitHookServiceProvider;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Facade;

class Console extends Facade
{
    protected static $accessor = 'githook.console';

    protected static function getFacadeAccessor()
    {
        if (!static::$app) {
            $container = new Container();
            $provider = new GitHookServiceProvider($container);
            $provider->boot();

            static::$app = $container;
        }

        return static::$accessor;
    }
}
