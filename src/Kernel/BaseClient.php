<?php

namespace Lucifer\DingTalk\ThirdParty\Enterprise\Kernel;

class BaseClient
{
    /**
     * @var \Lucifer\DingTalk\ThirdParty\Enterprise\Application
     */
    protected $app;

    /**
     * @var \Lucifer\DingTalk\ThirdParty\Enterprise\Kernel\Http\Client
     */
    protected $client;

    /**
     * Client constructor.
     *
     * @param \Lucifer\DingTalk\ThirdParty\Enterprise\Application $app
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
        $this->client->withAccessToken($accessToken);

        return $this;
    }
}
