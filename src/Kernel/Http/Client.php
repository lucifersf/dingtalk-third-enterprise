<?php

namespace LuciferDingTalk\Kernel\Http;

use Overtrue\Http\Client as BaseClient;
use Psr\Http\Message\RequestInterface;

class Client extends BaseClient
{
    /**
     * @var \LuciferDingTalk\Application
     */
    protected $app;

    /**
     * @var array
     */
    protected static $httpConfig = [
        'base_uri' => 'https://oapi.dingtalk.com',
    ];

    /**
     * @param \LuciferDingTalk\Application $app
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

    /**
     * @param $accessToken
     * @return $this
     */
    public function withAccessTokenMiddleware($accessToken)
    {
        $middleware = function (callable $handler) use ($accessToken) {
            return function (RequestInterface $request, array $options) use ($handler, $accessToken) {
                parse_str($request->getUri()->getQuery(), $query);

                $request = $request->withUri(
                    $request->getUri()->withQuery(http_build_query(['access_token' => $accessToken] + $query))
                );

                return $handler($request, $options);
            };
        };

        $this->pushMiddleware($middleware, 'access_token');

        return $this;
    }
}
