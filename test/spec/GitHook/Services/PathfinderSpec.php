<?php

namespace spec\GitHook\Services;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PathfinderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GitHook\Services\Pathfinder');
    }

    function it_should_retrieve_users_home_dir()
    {
        putenv("HOME=/some/folder");
        $this->getUserHomeDirectory()->shouldEqual('/some/folder');
    }

    function it_should_retrieve_users_home_path_and_dir()
    {
        putenv("HOME=");
        putenv("HOMEDRIVE=C:");
        putenv("HOMEPATH=\\Users\\someuser");

        $this->getUserHomeDirectory()->shouldEqual('C:\Users\someuser');
    }

    function it_should_throw_exception_if_user_home_dir_cannot_be_found()
    {
        putenv("HOME=");
        putenv("HOMEDRIVE=");
        putenv("HOMEPATH=");

        $this->shouldThrow('\Exception')->during('getUserHomeDirectory');
    }

    function it_should_retrieve_configuration_directory()
    {
        putenv("HOME=/Users/someuser");
        $expected = getenv("HOME").'/.githook';

        $this->getConfigurationDirectory()->shouldEqual($expected);
    }
}
