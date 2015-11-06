<?php

namespace spec\GitHook\Services\Hook;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TasksSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf('GitHook\Services\Hook\Tasks');
    }

}
