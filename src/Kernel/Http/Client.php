<?php

namespace Lucifer\DingTalk\ThirdParty\Enterprise\Kernel\Http;

use Overtrue\Http\Client as BaseClient;
use Psr\Http\Message\RequestInterface;

class Client extends BaseClient
{
    /**
     * @var \Lucifer\DingTalk\ThirdParty\Enterprise\Application
     */
    protected $app;

    /**
     * @var array
     */
    protected static $httpConfig = [
        'base_uri' => 'https://oapi.dingtalk.com',
    ];

    protected $accessToken;

    /**
     * @param \Lucifer\DingTalk\ThirdParty\Enterprise\Application $app
     */
    public function __construct($app)
    {
        $this->app = $app;

        parent::__construct(array_merge(static::$httpConfig, $this->app['config']->get('http', [])));
    }

    /**
     * @param array $config
     */
    public function setHttpConfig(array $config)
    {
        static::$httpConfig = array_merge(static::$httpConfig, $config);
    }

    protected function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @param $accessToken
     * @return $this
     */
    public function withAccessTokenMiddleware($accessToken)
    {
        $this->setAccessToken($accessToken);

        if (isset($this->getMiddlewares()['access_token'])) {
            return $this;
        }

        $middleware = function (callable $handler)  {
            return function (RequestInterface $request, array $options) use ($handler) {
                parse_str($request->getUri()->getQuery(), $query);

                $request = $request->withUri(
                    $request->getUri()->withQuery(http_build_query(['access_token' => $this->accessToken] + $query))
                );

                return $handler($request, $options);
            };
        };

        $this->pushMiddleware($middleware, 'access_token');

        return $this;
    }
}
