<?php

namespace spec\GitHook;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GitHookSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GitHook\GitHook');
    }
}
