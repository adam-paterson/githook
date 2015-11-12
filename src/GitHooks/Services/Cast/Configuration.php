<?php

namespace GitHooks\Services\Cast;

use GitHooks\Facades\GitHooks;
use GitHooks\Traits\HasLocator as GitHooksHasLocator;
use Rocketeer\Services\Ignition\Configuration as RocketeerConfiguration;

class Configuration extends RocketeerConfiguration
{
    use GitHooksHasLocator;

    protected function bindConfiguration()
    {
        $path = $this->paths->getBasePath().'.githooks';

        $storage = $path;

        $paths = [
            'config'     => $path.'',
            'events'     => $path.DS.'events',
            'plugins'    => $path.DS.'plugins',
            'tasks'      => $path.DS.'tasks',
            'logs'       => $storage.DS.'logs',
        ];

        foreach ($paths as $key => $file) {
            // Check whether we provided a file or folder
            if (!is_dir($file) && file_exists($file.'.php')) {
                $file .= '.php';
            }

            // Use configuration in current folder if none found
            $realpath = realpath('.').DS.basename($file);
            if (!file_exists($file) && file_exists($realpath)) {
                $file = $realpath;
            }

            $this->app->instance('path.githooks.'.$key, $file);
        }
    }

    protected function loadFileOrFolder($handle)
    {
        GitHooks::setFacadeApplication($this->app);

        $file = $this->app['path.githooks.'.$handle];
        if (!is_dir($file) && file_exists($file)) {
            include $file;
        } elseif (is_dir($file)) {
            $folder = glob($file.DS.'*.php');
            foreach ($folder as $file) {
                include $file;
            }
        }
    }

    public function loadUserConfiguration()
    {
        $fileLoaders = function () {
            $this->loadFileOrFolder('tasks');
            $this->loadFileOrFolder('events');
        };

        // Defer loading of tasks and events or not
        if (is_a($this->app, 'Illuminate\Foundation\Application')) {
            $this->app->booted($fileLoaders);
        } else {
            $fileLoaders();
        }

//        // Load plugins
//        $plugins = (array) $this->config->get('githooks::plugins');
//        $plugins = array_filter($plugins, 'class_exists');
//        foreach ($plugins as $plugin) {
//            $this->tasks->plugin($plugin);
//        }
//
//        // Merge contextual configurations
//        $this->mergeContextualConfigurations();
//        $this->mergePluginsConfiguration();
    }
}
