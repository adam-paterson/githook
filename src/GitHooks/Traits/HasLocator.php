<?php

namespace GitHooks\Traits;

use Illuminate\Container\Container;
use Rocketeer\Traits\HasLocator as RocketeerHasLocator;

trait HasLocator
{
    public function __construct(Container $app)
    {
        parent::__construct($app);
    }

    public function __get($key)
    {
        $shortcuts = [
            'bash'            => 'githooks.bash',
            'builder'         => 'githooks.builder',
            'command'         => 'githooks.command',
            'connections'     => 'githooks.connections',
            'console'         => 'githooks.console',
            'credentials'     => 'githooks.credentials',
            'environment'     => 'githooks.environment',
            'explainer'       => 'githooks.explainer',
            'history'         => 'githooks.history',
            'localStorage'    => 'githooks.storage.local',
            'logs'            => 'githooks.logs',
            'paths'           => 'githooks.paths',
            'queue'           => 'githooks.queue',
            'releasesManager' => 'githooks.releases',
            'remote'          => 'githooks.remote',
            'githooks'        => 'githooks.githooks',
            'scm'             => 'githooks.scm',
            'tasks'           => 'githooks.tasks',
            'timer'           => 'githooks.timer',
        ];

        // Replace shortcuts
        if (isset($shortcuts[$key])) {
            $key = $shortcuts[$key];
        }

        return $this->app[$key];
    }
}
