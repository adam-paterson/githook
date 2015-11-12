<?php

namespace GitHooks\Services\Storages;

use GitHooks\Traits\HasLocator as GitHooksHasLocator;
use Rocketeer\Services\Storages\LocalStorage as RocketeerLocalStorage;

class LocalStorage extends RocketeerLocalStorage
{
    use GitHooksHasLocator;

    public function getHash()
    {
        // Return cached hash if any
        if ($this->hash) {
            return $this->hash;
        }

        // Get the contents of the configuration folder
        $salt   = '';
        $folder = $this->paths->getConfigurationPath();
        $files  = (array) $this->files->glob($folder.'/*.php');

        // Remove custom files and folders
        foreach (['events', 'tasks'] as $handle) {
            $path  = $this->app['path.githooks.'.$handle];
            $index = array_search($path, $files, true);
            if ($index !== false) {
                unset($files[$index]);
            }
        }

        // Compute the salts
        foreach ($files as $file) {
            $file = $this->files->getRequire($file);
            $salt .= json_encode($file);
        }

        // Cache it
        $this->hash = md5($salt);

        return $this->hash;
    }
}
