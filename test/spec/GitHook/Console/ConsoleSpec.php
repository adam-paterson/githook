<?php

namespace spec\GitHook\Console;

use Illuminate\Container\Container;
use Illuminate\Contracts\Events\Dispatcher;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcher;

class ConsoleSpec extends ObjectBehavior
{
    public function let(Container $container, Dispatcher $dispatcher, $string)
    {
        $this->beConstructedWith($container, $dispatcher, $string);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Illuminate\Console\Application');
    }

    function it_has_application_name()
    {
        $this->getName()->shouldReturn('GitHook');
    }

    function it_has_application_description()
    {
        $this->getLongVersion()->shouldReturn('<info>GitHook</info> version <comment>1.0.0</comment>');
    }
}
