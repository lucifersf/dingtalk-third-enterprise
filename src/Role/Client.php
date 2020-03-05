<?php

namespace Lucifer\DingTalk\ThirdParty\Enterprise\Role;

use Lucifer\DingTalk\ThirdParty\Enterprise\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取角色列表
     *
     * @param int $offset
     * @param int $size
     *
     * @return mixed
     */
    public function list($offset = null, $size = null)
    {
        return $this->client->postJson('topapi/role/list', compact('offset', 'size'));
    }

    /**
     * 获取角色下的员工列表
     *
     * @param int $roleId
     * @param int $offset
     * @param int $size
     *
     * @return mixed
     */
    public function getUsers($roleId, $offset = null, $size = null)
    {
        return $this->client->postJson('topapi/role/simplelist', compact('offset', 'size') + ['role_id' => $roleId]);
    }

    /**
     * 获取角色组
     *
     * @param int $groupId
     *
     * @return mixed
     */
    public function getGroups($groupId)
    {
        return $this->client->postJson('topapi/role/getrolegroup', ['group_id' => $groupId]);
    }

    /**
     * 获取角色详情
     *
     * @param int $roleId
     *
     * @return mixed
     */
    public function get($roleId)
    {
        return $this->client->postJson('topapi/role/getrole', compact('roleId'));
    }
}