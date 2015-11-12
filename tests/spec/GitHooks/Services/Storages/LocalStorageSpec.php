<?php

namespace spec\GitHooks\Services\Storages;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LocalStorageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GitHooks\Services\Storages\LocalStorage');
    }
}
