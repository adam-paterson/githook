<?php

namespace GitHooks\Abstracts;

use Rocketeer\Abstracts\AbstractCommand as RocketeerAbstractCommand;

abstract class AbstractCommand extends RocketeerAbstractCommand
{
    public function getName()
    {
        $name = str_replace('githook:', null, $this->name);
        $name = str_replace('-', ':', $name);

        return $name;
    }

    protected function fireTasksQueue($tasks)
    {
        // Bind command to container
        $this->laravel->instance('githooks.command', $this);

        if ($this->straight) {
            // If we only have a single task, run it
            $status = $this->laravel['githooks.builder']->buildTask($tasks)->fire();
        } else {
            // Run tasks and display timer
            $status = $this->time(function () use ($tasks) {
                $pipeline = $this->laravel['githooks.queue']->run($tasks);

                return $pipeline->succeeded();
            });
        }

        // Remove command instance
        unset($this->laravel['githooks.command']);

        // Save history to logs
        $logs = $this->laravel['githooks.logs']->write();
        foreach ($logs as $log) {
            $this->info('Saved logs to '.$log);
        }

        return $status ? 0 : 1;
    }
}
