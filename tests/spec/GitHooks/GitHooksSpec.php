<?php

namespace spec\GitHooks;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GitHooksSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GitHooks\GitHooks');
    }
}
