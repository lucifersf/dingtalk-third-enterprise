<?php

namespace Lucifer\DingTalk\ThirdParty\Enterprise\Kernel\Http;

use Overtrue\Http\Client as BaseClient;

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

    /**
     * @param $accessToken
     * @return $this
     */
    public function withAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * @param string $url
     * @param array $query
     * @return mixed
     */
    public function get(string $url, array $query = [])
    {
        $query['access_token'] = $this->accessToken;

        return parent::get($url, $query);
    }

    /**
     * @param string $url
     * @param array $data
     * @param array $query
     * @return mixed
     */
    public function postQuery(string $url, array $data = [], array $query = [])
    {
        $query['access_token'] = $this->accessToken;
        return $this->request($url, 'POST', ['form_params' => $data, 'query' => $query]);
    }

    /**
     * @param string $url
     * @param array $data
     * @param array $query
     * @return mixed
     */
    public function postJson(string $url, array $data = [], array $query = [])
    {
        $query['access_token'] = $this->accessToken;

        return parent::postJson($url, $data, $query);
    }

}
