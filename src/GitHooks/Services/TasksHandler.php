<?php

namespace GitHooks\Services;

use GitHooks\Traits\HasLocator as GitHooksHasLocator;
use Rocketeer\Abstracts\AbstractTask;
use Rocketeer\Console\Commands\BaseTaskCommand;
use Rocketeer\Services\TasksHandler as RocketeerTasksHandler;
use Rocketeer\Tasks;

class TasksHandler extends RocketeerTasksHandler
{
    use GitHooksHasLocator;

    public function add($task, $name = null, $description = null)
    {
        // Build task if necessary
        $task = $this->builder->buildTask($task, $name, $description);
        $slug = 'githooks.tasks.'.$task->getSlug();

        // Add the task to Rocketeer
        $this->app->instance($slug, $task);
        $bound = $this->console->add(new BaseTaskCommand($this->app[$slug]));

        // Bind to Artisan too
        if ($this->app->bound('artisan') && $this->app->resolved('artisan')) {
            $command = $this->builder->buildCommand($task);
            $this->app['artisan']->add($command);
        }

        return $bound;
    }

    public function registerConfiguredEvents()
    {
        // Clean previously registered events
        foreach ($this->registeredEvents as $event) {
            $this->events->forget('githooks.'.$event);
        }

        // Clean previously registered plugins
        $plugins                 = $this->registeredPlugins;
        $this->registeredPlugins = [];

        // Register plugins again
        foreach ($plugins as $plugin) {
            $this->plugin($plugin['plugin'], $plugin['configuration']);
        }

        // Get the registered events
        $hooks = (array) $this->githooks->getOption('hooks');
        unset($hooks['custom']);

        // Bind events
        foreach ($hooks as $event => $tasks) {
            foreach ($tasks as $task => $listeners) {
                $this->addTaskListeners($task, $event, $listeners, 0, true);
            }
        }
    }

    public function listenTo($event, $listeners, $priority = 0)
    {
        /** @type AbstractTask[] $listeners */
        $listeners = $this->builder->buildTasks((array) $listeners);

        // Register events
        foreach ($listeners as $listener) {
            $listener->setEvent($event);
            $this->events->listen('githooks.'.$event, [$listener, 'fire'], $priority);
        }

        return $event;
    }

    public function getTasksListeners($task, $event, $flatten = false)
    {
        // Get events
        $task   = $this->builder->buildTaskFromClass($task)->getSlug();
        $events = $this->events->getListeners('githooks.'.$task.'.'.$event);

        // Flatten the queue if requested
        foreach ($events as $key => $event) {
            $task = $event[0];
            if ($flatten && $task instanceof Tasks\Closure && $stringTask = $task->getStringTask()) {
                $events[$key] = $stringTask;
            } elseif ($flatten && $task instanceof AbstractTask) {
                $events[$key] = $task->getSlug();
            }
        }

        return $events;
    }

    public function plugin($plugin, array $configuration = [])
    {
        // Build plugin
        if (is_string($plugin)) {
            $plugin = $this->app->make($plugin, [$this->app]);
        }

        // Store registration of plugin
        $identifier = get_class($plugin);
        if (isset($this->registeredPlugins[$identifier])) {
            return;
        }

        $this->registeredPlugins[$identifier] = [
            'plugin'        => $plugin,
            'configuration' => $configuration,
        ];

        // Register configuration
        $vendor = $plugin->getNamespace();
        $this->config->package('adam-paterson/'.$vendor, $plugin->configurationFolder);
        if ($configuration) {
            $this->config->set($vendor.'::config', $configuration);
        }

        // Bind instances
        $this->app = $plugin->register($this->app);

        // Add hooks to TasksHandler
        $plugin->onQueue($this);
    }
}
