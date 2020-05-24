<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\User;

class Home extends Base
{

    /**
     * 获取登录用户信息
     */
    public function getUserInfo()
    {

        $uid = $this->getUserId();

        $data = User::with('profile')->find($uid);

        return success(['list'=>$data]);
    }
}
