<?php

namespace LuciferDingTalk\Contact;

use LuciferDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取外部联系人标签列表
     *
     * @param int $offset
     * @param int $size
     *
     * @return mixed
     */
    public function labels($offset = 0, $size = 100)
    {
        return $this->client->postJson('topapi/extcontact/listlabelgroups', compact('offset', 'size'));
    }

    /**
     * 获取外部联系人列表
     *
     * @param int $offset
     * @param int $size
     *
     * @return mixed
     */
    public function list($offset = 0, $size = 100)
    {
        return $this->client->postJson('topapi/extcontact/list', compact('offset', 'size'));
    }

    /**
     * 获取企业外部联系人详情
     *
     * @param string $userId
     *
     * @return mixed
     */
    public function get($userId)
    {
        return $this->client->postJson('topapi/extcontact/get', ['user_id' => $userId]);
    }

    /**
     * 获取通讯录权限范围
     *
     * @return mixed
     */
    public function scopes()
    {
        return $this->client->get('auth/scopes');
    }
}
