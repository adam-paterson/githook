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
        if (!empty($_SERVER['HOME'])) {
            return $_SERVER['HOME'];
        } elseif (!empty($_SERVER['HOMEDRIVE']) && !empty($_SERVER['HOMEPATH'])) {
            return $_SERVER['HOMEDRIVE'] . $_SERVER['HOMEPATH'];
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
