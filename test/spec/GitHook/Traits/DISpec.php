<?php

namespace spec\GitHook;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DISpec extends ObjectBehavior
{
    function it_is_initializable ()
    {
        $this->shouldHaveType('GitHook\Traits\DI');
    }
}
