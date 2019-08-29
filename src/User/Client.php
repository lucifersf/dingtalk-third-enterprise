<?php

namespace LuciferDingTalk\User;

use LuciferDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{

    /**
     * 获取用户userid
     *
     * @param string      $code
     *
     * @return mixed
     */
    public function getUserId($code)
    {
        return $this->client->get('user/getuserinfo', ['code' => $code]);
    }

    /**
     * 获取用户详情
     *
     * @param string      $userid
     * @param string|null $lang
     *
     * @return mixed
     */
    public function get($userid, $lang = null)
    {
        return $this->client->get('user/get', compact('userid', 'lang'));
    }

    /**
     * 获取部门用户 Userid 列表
     *
     * @param int $departmentId
     *
     * @return mixed
     */
    public function getUserIds($departmentId)
    {
        return $this->client->get('user/getDeptMember', ['deptId' => $departmentId]);
    }

    /**
     * 获取部门用户
     *
     * @param int    $departmentId
     * @param int    $offset
     * @param int    $size
     * @param string $order
     * @param string $lang
     *
     * @return mixed
     */
    public function getUsers($departmentId, $offset, $size, $order = null, $lang = null)
    {
        return $this->client->get('user/simplelist', [
            'department_id' => $departmentId, 'offset' => $offset, 'size' => $size, 'order' => $order, 'lang' => $lang,
        ]);
    }

    /**
     * 获取部门用户详情
     *
     * @param int    $departmentId
     * @param int    $offset
     * @param int    $size
     * @param string $order
     * @param string $lang
     *
     * @return mixed
     */
    public function getDetailedUsers($departmentId, $offset, $size, $order = null, $lang = null)
    {
        return $this->client->get('user/listbypage', [
            'department_id' => $departmentId, 'offset' => $offset, 'size' => $size, 'order' => $order, 'lang' => $lang,
        ]);
    }

    /**
     * 获取管理员列表
     *
     * @return mixed
     */
    public function administrators()
    {
        return $this->client->get('user/get_admin');
    }

    /**
     * 获取管理员通讯录权限范围
     *
     * @param string $userid
     *
     * @return mixed
     */
    public function administratorScope($userid)
    {
        return $this->client->get('topapi/user/get_admin_scope', compact('userid'));
    }

    /**
     * 根据 Unionid 获取 Userid
     *
     * @param string $unionid
     *
     * @return mixed
     */
    public function getUseridByUnionid($unionid)
    {
        return $this->client->get('user/getUseridByUnionid', compact('unionid'));
    }

    /**
     * 获取企业员工人数
     *
     * @param int $onlyActive
     *
     * @return mixed
     */
    public function getCount($onlyActive = 0)
    {
        return $this->client->get('user/get_org_user_count', compact('onlyActive'));
    }

}
