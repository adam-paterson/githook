<?php

namespace GitHooks\Tasks;

use GitHooks\Abstracts\AbstractTask;

class Cast extends AbstractTask
{
    protected $description = "Creates .git/hooks configuration";

    public function execute()
    {
        $path = $this->createConfiguration();

        $this->app['githooks.cast']->updateConfiguration($path);
    }

    protected function createConfiguration()
    {
        return $this->app['githooks.cast']->exportConfiguration();
    }
}
