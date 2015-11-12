<?php

namespace spec\GitHooks\Services\Tasks;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TasksBuilderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GitHooks\Services\Tasks\TasksBuilder');
    }
}
