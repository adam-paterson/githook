<?php

namespace spec\GitHooks\Console\Commands;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GitHooksCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GitHooks\Console\Commands\GitHooksCommand');
    }
}
