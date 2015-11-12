<?php

namespace GitHooks\Abstracts;

use GitHooks\Traits\HasLocator as GitHooksHasLocator;
use Rocketeer\Abstracts\AbstractTask as RocketeerAbstractTask;

abstract class AbstractTask extends RocketeerAbstractTask
{
    use GitHooksHasLocator;

    public function getQualifiedEvent($event)
    {
        return 'githooks.'.$this->getSlug().'.'.$event;
    }
}
