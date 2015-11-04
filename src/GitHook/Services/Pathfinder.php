<?php

namespace GitHook\Services;

use Dotenv\Dotenv;

/**
 * Class Pathfinder
 * @author Adam Paterson <adamp@hello@adampaterson.co.uk
 *
 * @package GitHook\Services
 */
class Pathfinder
{
    /**
     * Get the user's home directory path.
     *
     * @return string
     * @throws \Exception
     */
    public static function getUserHomeDirectory()
    {
        if (!empty(getenv('HOMEDRIVE')) && !empty(getenv('HOMEPATH'))) {
            $dir = getenv('HOMEDRIVE') . getenv('HOMEPATH');
        }

        if (!empty(getenv('HOME'))) {
            $dir = getenv('HOME');
        }

        if (!isset($dir)) {
            throw new \Exception("Cannot determine user home directory.");
        }

        return $dir;
    }

    /**
     * Get GitHook configuration directory in the users home.
     *
     * @return string
     * @throws \Exception
     */
    public function getConfigurationDirectory()
    {
        return $this->getUserHomeDirectory().'/.githook';
    }
}
