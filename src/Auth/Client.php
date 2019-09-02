<?php

namespace Lucifer\DingTalk\ThirdParty\Enterprise\Auth;

use Lucifer\DingTalk\ThirdParty\Enterprise\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取企业凭证
     *
     * @param string $suiteTicket
     * @param string $corpId
     *
     * @return mixed
     */
    public function getAccessToken($suiteTicket, $corpId)
    {
        return $this->client->postJson('service/get_corp_token', ['auth_corpid' => $corpId], $this->makeQuery($suiteTicket));
    }

    /**
     * 获取企业授权信息
     *
     * @param string $suiteTicket
     * @param string $corpId
     *
     * @return mixed
     */
    public function getEnterprise($suiteTicket, $corpId)
    {
        return $this->client->postJson('service/get_auth_info', ['auth_corpid' => $corpId], $this->makeQuery($suiteTicket));
    }

    /**
     * 获取授权应用信息
     *
     * @param string $suiteTicket
     * @param int $agentId
     * @param string $corpId
     *
     * @return mixed
     */
    public function getAgent($suiteTicket, $agentId, $corpId)
    {
        $params = [
            'auth_corpid' => $corpId,
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