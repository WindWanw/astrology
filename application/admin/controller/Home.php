<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\User;

class Home extends Base
{

    public function __construct()
    {

        $this->user = User::getInstance();
    }
    /**
     * 获取登录用户信息
     */
    public function getUserInfo()
    {

        $uid = $this->getUserId();

        $data = $this->user->with('profile')->find($uid);

        return success(['list' => $data]);
    }
}
