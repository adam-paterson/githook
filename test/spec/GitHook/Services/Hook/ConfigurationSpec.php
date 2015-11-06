<?php

namespace spec\GitHook\Services\Hook;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigurationSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf('GitHook\Services\Hook\Configuration');
    }
}
