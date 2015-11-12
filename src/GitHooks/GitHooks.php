<?php

namespace GitHooks;

use GitHooks\Traits\HasLocator as GitHooksHasLocator;
use Rocketeer\Rocketeer;

class GitHooks extends Rocketeer
{
    use GitHooksHasLocator;

    const VERSION = '1.0.0';

    public function getApplicationName()
    {
        return $this->config->get('githooks::application_name');
    }

    public function getOption($option)
    {
        return $this->config->get('githooks::'.$option);
    }

    protected function getContextualOption($option, $type, $original = null)
    {
        $contextual = sprintf('rocketeer::%s', $option);

        // Merge with defaults
        $value = $this->config->get($contextual);
        if (is_array($value) && $original) {
            $value = array_replace($original, $value);
        }

        return $value;
    }
}
