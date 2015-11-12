<?php

namespace GitHooks\Services\Display;

use GitHooks\Traits\HasLocator as GitHooksHasLocator;
use Rocketeer\Services\Display\QueueTimer as RocketeerQueueTimer;

class QueueTimer extends RocketeerQueueTimer
{
    use GitHooksHasLocator;
}
