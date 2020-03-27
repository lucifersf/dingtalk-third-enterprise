<?php

namespace Lucifer\DingTalk\ThirdParty\Enterprise;

use Overtrue\Http\Support\Collection;
use Pimple\Container;

class Application extends Container
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        User\ServiceProvider::class,
        Contact\ServiceProvider::class,
        Department\ServiceProvider::class,
        Conversation\ServiceProvider::class,
        Role\ServiceProvider::class,
        Buy\ServiceProvider::class,
        Kernel\Providers\ClientServiceProvider::class,
        Kernel\Providers\LoggerServiceProvider::class,
    ];

    /**
     * Application constructor.
     *
     * @param array $config
     * @param array $values
     */
    public function __construct($config = [], array $values = [])
    {
        parent::__construct($values);

        $this['config'] = function () use ($config) {
            return new Collection($config);
        };

        foreach ($this->providers as $provider) {
            $this->register(new $provider());
        }
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this[$name];
    }
}
