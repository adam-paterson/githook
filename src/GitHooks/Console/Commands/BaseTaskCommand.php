<?php

namespace GitHooks\Console\Commands;

use GitHooks\Abstracts\AbstractCommand;

class BaseTaskCommand extends AbstractCommand
{
    protected $name = 'githook:custom';

    public function __construct($task, $name)
    {
        parent::__construct($task);

        // Set name
        if ($this->name === 'githook:custom' && $task) {
            $this->name = $name ?: $task->getSlug();
            $this->name = 'githook:'.$this->name;
        }
    }

    public function fire()
    {
        return $this->fireTasksQueue($this->task->getSlug());
    }
}
