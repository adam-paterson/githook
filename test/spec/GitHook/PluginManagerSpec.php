<?php

namespace spec\GitHook;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PluginManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GitHook\PluginManager');
    }

    function is_should_load_local_plugins()
    {

    }
}
