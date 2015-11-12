<?php

namespace spec\GitHooks\Console\Commands;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CastCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GitHooks\Console\Commands\CastCommand');
    }
}
