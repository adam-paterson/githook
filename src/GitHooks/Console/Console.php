<?php

namespace GitHooks\Console;

use GitHooks\GitHooks;
use GitHooks\Traits\HasLocator as GitHooksHasLocator;
use Illuminate\Container\Container;
use Rocketeer\Console\Console as RocketeerConsole;
use Symfony\Component\Console\Application;

class Console extends RocketeerConsole
{
    use GitHooksHasLocator;

    public function __construct(Container $app)
    {
        $this->app = $app;

        Application::__construct('GitHooks');
    }

    public function getLongVersion()
    {
        $version = GitHooks::COMMIT === '@commit@' ? '(dev version)' : GitHooks::COMMIT;
        return sprintf(
            '<info>%s</info> <comment>%s</comment>',
            $this->getName(),
            $version
        );
    }


    protected function getCurrentState()
    {
        return [

        ];
    }
}
