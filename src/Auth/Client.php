<?php

namespace LuciferDingTalk\Auth;

use LuciferDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取企业凭证
     *
     * @param string $suiteTicket
     *
     * @return mixed
     */
    public function getAccessToken($suiteTicket)
    {
        $params = ['auth_corpid' => $this->app['config']->get('corp_id'),];

        return $this->client->postJson('service/get_corp_token', $params, $this->makeQuery($suiteTicket));
    }

    /**
     * 获取企业授权信息
     *
     * @param string $suiteTicket
     *
     * @return mixed
     */
    public function getEnterprise($suiteTicket)
    {
        $params = ['auth_corpid' => $this->app['config']->get('corp_id'),];
        return $this->client->postJson('service/get_auth_info', $params, $this->makeQuery($suiteTicket));
    }

    /**
     * 获取授权应用信息
     *
     * @param string $suiteTicket
     * @param int $agentId
     *
     * @return mixed
     */
    public function getAgent($suiteTicket, $agentId)
    {
        $params = [
            'auth_corpid' => $this->app['config']->get('corp_id'),
            'suite_key' => $this->app['config']->get('suite_key'),
            'agentid' => $agentId,
        ];
        return $this->client->postJson('service/get_agent', $params, $this->makeQuery($suiteTicket));
    }

    /**
     * 计算签名
     *
     * @param int $timestamp
     * @param string $suiteTicket
     *
     * @return string
     */
    protected function signature($timestamp, $suiteTicket)
    {
        $data = $timestamp."\n".$suiteTicket;
        return base64_encode(hash_hmac('sha256', $data, $this->app['config']->get('suite_secret'), true));
    }

    /**
     * 生成query参数
     *
     * @param $suiteTicket
     *
     * @return array
     */
    protected function makeQuery($suiteTicket)
    {
        $timestamp = (int)(microtime(true) * 1000);

        return [
            'accessKey' => $this->app['config']->get('suite_key'),
            'timestamp' => $timestamp,
            'suiteTicket' => $suiteTicket,
            'signature' => $this->signature($timestamp, $suiteTicket),
        ];
    }
}