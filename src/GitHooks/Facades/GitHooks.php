<?php

namespace GitHooks\Facades;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;

class GitHooks extends StandAloneFacade
{
    protected static $accessor = 'githooks.tasks';
}
