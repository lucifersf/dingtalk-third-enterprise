<?php

namespace LuciferDingTalk\Kernel;

class BaseClient
{
    /**
     * @var \LuciferDingTalk\Application
     */
    protected $app;

    /**
     * @var \LuciferDingTalk\Kernel\Http\Client
     */
    protected $client;

    /**
     * Client constructor.
     *
     * @param \LuciferDingTalk\Application $app
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->client = $this->app['client'];
    }

    /**
     * @param $accessToken
     * @return $this
     */
    public function withAccessToken($accessToken)
    {
        $this->client = $this->client->withAccessTokenMiddleware($accessToken);

        return $this;
    }
}
