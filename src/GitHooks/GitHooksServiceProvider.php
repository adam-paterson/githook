<?php

namespace GitHooks;

use GitHooks\Services\Display\QueueExplainer;
use Illuminate\Config\FileLoader;
use Illuminate\Config\Repository;
use Illuminate\Events\Dispatcher;
use Illuminate\Log\Writer;
use Monolog\Logger;
use Rocketeer\RocketeerServiceProvider;
use Illuminate\Container\Container;
use GitHooks\Services\Cast\Configuration;
use GitHooks\Services\Cast\Tasks;
use GitHooks\Services\Display\QueueTimer;
use GitHooks\Services\Pathfinder;
use GitHooks\Console\Console;
use GitHooks\Services\TasksHandler;
use GitHooks\Services\Tasks\TasksBuilder;
use GitHooks\Services\Storages\LocalStorage;
use Rocketeer\Services\History\LogsHandler;

class GitHooksServiceProvider extends RocketeerServiceProvider
{
    public function register()
    {
        if (!$this->app->bound(Container::class)) {
            $this->app->instance(Container::class, $this->app);
        }

        $this->bindPaths();
        $this->bindThirdPartyServices();

        $this->bindCoreClasses();
        $this->bindConsoleClasses();

        $this->app['githooks.cast']->loadUserConfiguration();
        $this->app['githooks.tasks']->registerConfiguredEvents();

        $this->bindCommands();
    }

    public function bindThirdPartyServices()
    {
        $this->app->bindIf('files', 'Illuminate\Filesystem\Filesystem');

        $this->app->bindIf('config', function ($app) {
            $fileloader = new FileLoader($app['files'], __DIR__.'/../config');

            return new Repository($fileloader, 'config');
        }, true);

        $this->app->bindIf('events', function ($app) {
            return new Dispatcher($app);
        }, true);

        $this->app->bindIf('log', function () {
            return new Writer(new Logger('rocketeer'));
        }, true);

        $this->registerConfig();
    }

    public function bindPaths()
    {
        $this->app->singleton('githooks.paths', Pathfinder::class);

        $this->app->bind('githooks.cast', Configuration::class);
        $this->app->bind('githooks.cast.tasks', Tasks::class);

        $this->app['githooks.cast']->bindPaths();
    }

    public function bindCoreClasses()
    {
        $this->app->singleton('githooks.builder', TasksBuilder::class);
        $this->app->singleton('githooks.githooks', GitHooks::class);
        $this->app->singleton('githooks.tasks', TasksHandler::class);
        $this->app->singleton('githooks.timer', QueueTimer::class);
        $this->app->singleton('githooks.explainer', QueueExplainer::class);
        $this->app->singleton('githooks.storage.local', function ($app) {
            $filename = $app['githooks.githooks']->getApplicationName();
            $filename = $filename === '{application_name}' ? 'hooks': $filename;

            return new LocalStorage($app, $filename);
        });
        $this->app->singleton('githooks.logs', LogsHandler::class);

    }

    public function bindConsoleClasses()
    {
        $this->app->singleton('githooks.console', Console::class);

        $this->app['githooks.console']->setLaravel($this->app);
    }

    public function bindCommands()
    {
        $tasks = $this->app['githooks.cast.tasks']->getPredefinedTasks();

        $commands = $this->app['githooks.cast.tasks']->registerTasksAndCommands($tasks);

        foreach ($commands as $command) {
            $this->app['githooks.console']->add($this->app[$command]);
        }
    }

    protected function registerConfig()
    {
        $this->app['config']->package('adam-paterson/githooks', __DIR__.'/../config');
        $this->app['config']->getLoader();

        $set = $this->app['path.githooks.config'];
        if (!file_exists($set)) {
            return;
        }

        $this->app['config']->afterLoading('githooks', function ($me, $group, $items) use ($set) {
            $customItems = $set.'/'.$group.'.php';
            if (!file_exists($customItems)) {
                return $items;
            }

            $customItems = include $customItems;

            return array_replace($items, $customItems);
        });
    }
}
