<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\User as UserModel;
use app\util\Enum;

class User extends Base
{

    public function __construct()
    {

        $this->user = UserModel::getInstance();
    }

    /**
     * 获取后台用户列表
     *
     * @return void
     */
    public function getUserList()
    {

        $list = $this->user->with(['profile' => function ($query) {
            $query->field(['create_time', 'update_time'], true);
        }])
            ->where('type', Enum::USER_TYPE_ADMIN)
            ->field(['id', 'username', 'pwd', 'nickname', 'avatar', 'status', 'create_time'])
            ->paginate(input('limit'));

        return success($list);
    }

    /**
     * 添加后台用户
     *
     * @return void
     */
    public function addUserInfo()
    {
        $data = input();

        $info = [
            'password' => \password_hash(input('pwd'), PASSWORD_DEFAULT),
            'reg_ip' => \getIpAddress(),
            'type' => Enum::USER_TYPE_ADMIN,
        ];

        $data = array_merge($data, $info);

        if ($this->user->allowField(true)->save($data)) {
            return success('添加成功');
        }

        return error('添加失败');
    }

    /**
     * 修改后台用户
     *
     * @return void
     */
    public function editUserInfo()
    {
        $data = input();

        if ($this->user->allowField(true)->save($data, ['id' => input('id')])) {
            return success('修改成功');
        }

        return error('修改失败');
    }
}
