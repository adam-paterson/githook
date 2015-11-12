<?php

namespace GitHooks\Services\Display;

use GitHooks\Traits\HasLocator as GitHookHasLocator;
use Rocketeer\Services\Display\QueueExplainer as RocketeerQueueExplainer;

class QueueExplainer extends RocketeerQueueExplainer
{
    use GitHookHasLocator;
}
