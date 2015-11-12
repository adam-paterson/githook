<?php

namespace spec\GitHooks;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GitHooksServiceProviderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GitHooks\GitHooksServiceProvider');
        $this->shouldHaveType('Rocketeer\RocketeerServiceProvider');
    }

    function it_should_register_core_classes_in_the_container()
    {

    }

    function it_should_register_console_classes_in_the_container()
    {

    }

    function it_should_register_paths__in_the_container()
    {

    }
}
