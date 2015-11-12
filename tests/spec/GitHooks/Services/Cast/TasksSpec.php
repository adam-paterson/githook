<?php

namespace spec\GitHooks\Services\Cast;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TasksSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GitHooks\Services\Cast\Tasks');
    }
}
