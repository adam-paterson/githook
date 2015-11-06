<?php

namespace GitHook\Traits;

use Illuminate\Container\Container;

trait DI
{
    protected $app;

    /**
     * DI constructor.
     *
     * @param $app
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function __get($key)
    {
        $shortcuts = [
            'paths' => 'githook.paths'
        ];

        if (isset($shortcuts[$key])) {
            $key = $shortcuts[$key];
        }

        return $this->app[$key];
    }
}
