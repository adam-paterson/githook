<?php

namespace GitHook\Console;

use GitHook\GitHook;
use Illuminate\Console\Application;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Events\Dispatcher;

class Console extends Application
{
    public function __construct(Container $container, Dispatcher $events, $version)
    {
        parent::__construct($container, $events, $version);
        $this->setName('GitHook');
    }

    public function getLongVersion()
    {
        return sprintf(
            '<info>%s</info> version <comment>%s</comment>',
            $this->getName(),
            GitHook::VERSION
        );
    }
}
