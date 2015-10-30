<?php

namespace GitHook\Console;

use GitHook\GitHook;
use Illuminate\Console\Application;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Events\Dispatcher;

/**
 * Class Console
 * @author Adam Paterson <hello@adampaterson.co.uk>
 *
 * @package GitHook\Console
 */
class Console extends Application
{
    /**
     * Set application name
     *
     * @param Container $container
     * @param Dispatcher $events
     * @param string $version
     */
    public function __construct(Container $container, Dispatcher $events, $version)
    {
        parent::__construct($container, $events, $version);
        $this->setName('GitHook');
    }

    /**
     * Get long application version with name
     *
     * @return string
     */
    public function getLongVersion()
    {
        return sprintf(
            '<info>%s</info> version <comment>%s</comment>',
            $this->getName(),
            GitHook::VERSION
        );
    }
}
