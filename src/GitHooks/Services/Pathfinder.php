<?php

namespace GitHooks\Services;

use GitHooks\Traits\HasLocator as GitHooksHasLocator;
use Rocketeer\Services\Pathfinder as RocketeerPathfinder;

class Pathfinder extends RocketeerPathfinder
{
    use GitHooksHasLocator;

    public function getRocketeerConfigFolder()
    {
        return $this->getGitHooksConfigFolder();
    }

    public function getGitHooksConfigFolder()
    {
        return $this->getUserHomeFolder().'/.githooks';
    }

    public function getConfigurationPath()
    {
        $configuration = $this->app['path.githooks.config'];

        return $this->unifyLocalSlashes($configuration);
    }
}
