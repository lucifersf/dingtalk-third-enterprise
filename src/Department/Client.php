<?php

namespace Lucifer\DingTalk\ThirdParty\Enterprise\Department;

use Lucifer\DingTalk\ThirdParty\Enterprise\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取子部门 ID 列表
     *
     * @param string $id 部门ID
     *
     * @return mixed
     */
    public function getSubDepartmentIds($id)
    {
        return $this->client->get('department/list_ids', compact('id'));
    }

    /**
     * 获取部门列表
     *
     * @param bool   $isFetchChild
     * @param string $id
     * @param string $lang
     *
     * @return mixed
     */
    public function list($id = null, bool $isFetchChild = false, $lang = null)
    {
        return $this->client->get('department/list', [
            'id' => $id, 'lang' => $lang, 'fetch_child' => $isFetchChild ? 'true' : 'false',
        ]);
    }

    /**
     * 获取部门详情
     *
     * @param string $id
     * @param string $lang
     *
     * @return mixed
     */
    public function get($id, $lang = null)
    {
        return $this->client->get('department/get', compact('id', 'lang'));
    }

    /**
     * 查询部门的所有上级父部门路径
     *
     * @param string $id
     *
     * @return mixed
     */
    public function getParentsById($id)
    {
        return $this->client->get('department/list_parent_depts_by_dept', compact('id'));
    }

    /**
     * 查询指定用户的所有上级父部门路径
     *
     * @param string $userId
     *
     * @return mixed
     */
    public function getParentsByUserId($userId)
    {
        return $this->client->get('department/list_parent_depts', compact('userId'));
    }
}
