<?php

namespace GitHook\Services\Hook;

use GitHook\Traits\DI;

/**
 * Class Configuration
 * @author Adam Paterson <adamp@junowebdesign.com>
 *
 * @package GitHook\Services\Hook
 */
class Configuration
{
    use DI;

    public function bindPaths()
    {
        $this->bindBase();
        $this->bindConfiguration();
    }

    protected function bindBase()
    {
        if ($this->app->bound('path.base')) {
            return;
        }

        $this->app->instance('path.base', getcwd());
    }

    protected function bindConfiguration()
    {
        $path = $this->paths->getBasePath().'.githook';

        $paths = [
            'config' => $path.'',
            'events' => $path.'events',
            'plugins' => $path.'plugins',
            'tasks' => $path.'tasks',
            'logs' => $path.'logs',
        ];

        foreach ($paths as $key => $file) {
            if (!is_dir($file) && file_exists($file.'.php')) {
                $file .= '.php';
            }

            $realpath = realpath('.').DS.basename($file);
            if (!file_exists($file) && file_exists($realpath)) {
                $file = $realpath;
            }

            $this->app->instance('path.githook.'.$key, $file);
        }
    }
}
