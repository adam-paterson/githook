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
        $_SERVER['HOME'] = '/some/folder';
        $this->getUserHomeDirectory()->shouldEqual('/some/folder');
    }

    function it_should_retrieve_users_home_path_and_dir()
    {
        unset($_SERVER['HOME']);
        $_SERVER['HOMEDRIVE'] = 'C:';
        $_SERVER['HOMEPATH']  = '\Users\someuser';

        $this->getUserHomeDirectory()->shouldEqual('C:\Users\someuser');
    }

    function it_should_throw_exception_if_user_home_dir_cannot_be_found()
    {
        unset($_SERVER['HOME']);
        unset($_SERVER['HOMEDRIVE']);
        unset($_SERVER['HOMEPATH']);

        $this->shouldThrow('\Exception')->during('getUserHomeDirectory');
    }

    function it_should_retrieve_configuration_directory()
    {
        $_SERVER['HOME'] = '/Users/someuser';
        $expected = $_SERVER['HOME'].'/.githook';

        $this->getConfigurationDirectory()->shouldEqual($expected);
    }
}
