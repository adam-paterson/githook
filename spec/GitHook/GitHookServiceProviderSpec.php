<?php

namespace spec\GitHook;

use Illuminate\Container\Container;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GitHookServiceProviderSpec extends ObjectBehavior
{
    public function let(Container $container)
    {
        $this->beConstructedWith($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('GitHook\GitHookServiceProvider');
    }
}
