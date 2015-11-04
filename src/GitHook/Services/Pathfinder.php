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
        if (!empty(getenv('HOME'))) {
            return getenv('HOME');
        } elseif (!empty(getenv('HOMEDRIVE')) && !empty(getenv('HOMEPATH'))) {
            return getenv('HOMEDRIVE') . getenv('HOMEPATH');
        } else {
            throw new \Exception("Cannot determine user home directory.");
        }
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
