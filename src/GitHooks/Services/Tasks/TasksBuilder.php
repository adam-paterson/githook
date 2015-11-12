<?php

namespace GitHooks\Services\Tasks;

use Closure;
use GitHooks\Abstracts\AbstractTask;
use GitHooks\Traits\HasLocator as GitHooksHasLocator;
use Illuminate\Support\Str;
use Rocketeer\Exceptions\TaskCompositionException;
use Rocketeer\Services\Tasks\TasksBuilder as RocketeerTasksBuilder;

class TasksBuilder extends RocketeerTasksBuilder
{
    use GitHooksHasLocator;

    public function buildCommand($task, $slug = null)
    {
        // Build the task instance
        try {
            $instance = $this->buildTask($task);
        } catch (TaskCompositionException $exception) {
            $instance = null;
        }

        // Get the command name
        $name    = $instance ? $instance->getName() : null;
        $command = $this->findQualifiedName($name, [
            'GitHooks\Console\Commands\%sCommand',
        ]);

        // If no command found, use BaseTaskCommand or task name
        if (!$command || $command === 'Closure') {
            $name    = is_string($task) ? $task : $name;
            $command = $this->findQualifiedName($name, [
                'GitHooks\Console\Commands\%sCommand',
                'GitHooks\Console\Commands\BaseTaskCommand',
            ]);
        }

        $command = new $command($instance, $slug);
        $command->setLaravel($this->app);

        return $command;
    }

    protected function getTaskHandle($task)
    {
        // Check the handle if possible
        if (!is_string($task)) {
            return;
        }

        // Compute the handle and check it's bound
        $handle = 'githooks.tasks.'.Str::snake($task, '-');
        $task   = $this->app->bound($handle) ? $handle : null;

        return $task;
    }

    protected function isStringCommand($string)
    {
        return is_string($string) && !$this->taskClassExists($string) && !$this->app->bound('githooks.tasks.'.$string);
    }

    protected function taskClassExists($task)
    {
        return $this->findQualifiedName($task, [
            'GitHooks\Tasks\%s',
            'GitHooks\Tasks\Subtasks\%s',
        ]);
    }

    protected function composeTask($task)
    {
        // If already built, return it
        if ($task instanceof AbstractTask) {
            return $task;
        }

        // If we provided a Closure, build a ClosureTask
        if ($task instanceof Closure) {
            return $this->buildTaskFromClosure($task);
        }

        // If we passed a task handle, return it
        if ($handle = $this->getTaskHandle($task)) {
            return $this->app[$handle];
        }

        // If we passed a command, build a ClosureTask
        if (is_array($task) || $this->isStringCommand($task) || is_null($task)) {
            return $this->buildTaskFromString($task);
        }

        // Else it's a class name, get the appropriated task
        if (!$task instanceof AbstractTask) {
            return $this->buildTaskFromClass($task);
        }
    }

    public function wrapStringTasks($stringTask)
    {
        return function (AbstractTask $task) use ($stringTask) {
            return $task->runForCurrentRelease($stringTask);
        };
    }
}
