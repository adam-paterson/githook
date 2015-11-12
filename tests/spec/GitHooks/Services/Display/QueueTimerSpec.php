<?php

namespace spec\GitHooks\Services\Display;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class QueueTimerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GitHooks\Services\Display\QueueTimer');
    }
}
