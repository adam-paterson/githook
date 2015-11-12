<?php

namespace spec\GitHooks\Services;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PathfinderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GitHooks\Services\Pathfinder');
    }
}
