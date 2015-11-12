<?php

namespace GitHooks\Services\Cast;

use Rocketeer\Services\Ignition\Tasks as RocketeerTasks;
use GitHooks\Traits\HasLocator as GitHooksHasLocator;

class Tasks extends RocketeerTasks
{
    use GitHooksHasLocator;

    public function getPredefinedTasks()
    {
        $tasks = [
            '' => 'GitHooks',
//            'flush' => 'Flush',
            'cast' => 'Cast',
//            'self-update' => 'Development\SelfUpdate',
//            'plugin-publish' => 'Plugins\Publish',
//            'plugin-list' => 'Plugins\List',
//            'plugin-install' => 'Plugins\Install',
//            'plugin-update' => 'Plugins\Update',
        ];

        // Add user commands
        $userTasks = (array) $this->config->get('hooks.custom');
        $userTasks = array_filter($userTasks);
        $tasks = array_merge($tasks, $userTasks);

        return $tasks;
    }

    public function registerTasksAndCommands(array $tasks)
    {
        $commands = [];

        foreach ($tasks as $slug => $task) {
            // Build the related command
            $command = $this->builder->buildCommand($task, $slug);
            $task    = $command->getTask();

            // Bind task to container
            $slug   = $this->getTaskHandle($slug, $task);
            $handle = 'githooks.tasks.'.$slug;
            $this->app->bind($handle, function () use ($task) {
                return $task;
            });

            // Remember handle of the command
            $commandHandle = trim('githooks.commands.'.$slug, '.');
            $commands[]    = $commandHandle;

            // Register command with the container
            $this->app->singleton($commandHandle, function () use ($command) {
                return $command;
            });
        }

        return $commands;
    }
}
