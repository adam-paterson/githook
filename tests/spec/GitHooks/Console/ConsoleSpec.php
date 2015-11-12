<?php

namespace spec\GitHooks\Console;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConsoleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GitHooks\Console\Console');
    }
}
