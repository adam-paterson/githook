<?php

namespace spec\GitHook\Facades;

use GitHook\Console\Console;
use GitHook\GitHook;
use GitHook\GitHookServiceProvider;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConsoleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GitHook\Facades\Console');
    }

    function it_should_extend_illimunate_facade()
    {
        $this->shouldhaveType('Illuminate\Support\Facades\Facade');
    }
}
