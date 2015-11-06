<?php

namespace spec\GitHook\Facades;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConsoleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GitHook\Facades\Console');
        $this->shouldHaveType('Illuminate\Support\Facades\Facade');
    }
}
