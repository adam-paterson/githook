<?php

namespace spec\GitHooks\Facades;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StandAloneFacadeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GitHooks\Facades\StandAloneFacade');
    }
}
