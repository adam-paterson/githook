<?php

namespace GitHooks\Facades;

use GitHooks\GitHooksServiceProvider;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;

abstract class StandAloneFacade extends Facade
{
    protected static $accessor;

    protected static function getFacadeAccessor()
    {
        if (!static::$app) {
            $container = new Container();
            $provider  = new GitHooksServiceProvider($container);
            $provider->register();

            static::$app = $container;
        }

        return static::$accessor;
    }
}
