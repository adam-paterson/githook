<?php

namespace GitHooks\Console\Commands;

class GitHooksCommand extends BaseTaskCommand
{
    protected $name = 'cast';

    public function fire()
    {
        $this->app->instance('githooks.command', $this);

        if ($this->option('version')) {
            return $this->output->writeln($this->console->getLongVersion());

        }
        return parent::fire();
    }
}
