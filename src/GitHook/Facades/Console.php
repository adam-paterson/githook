<?php

namespace GitHook\Facades;

use GitHook\GitHookServiceProvider;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;

/**
 * Class Console
 * @author Adam Paterson <hello@adampaterson.co.uk>
 *
 * @package GitHook\Facades
 */
class Console extends Facade
{
    /**
     * @var string
     */
    protected static $accessor = 'githook.console';

    /**
     * @return string
     */
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
