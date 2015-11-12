<?php

namespace spec\GitHooks\Tasks;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CastSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GitHooks\Tasks\Cast');
    }
}
