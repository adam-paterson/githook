<?php

namespace spec\GitHook\Abstracts;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AbstractCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GitHook\Abstracts\AbstractCommand');
    }

    function it_should_extend_illumnate_command()
    {
        $this->shouldHaveType('Illuminate\Console\Command');
    }
}
