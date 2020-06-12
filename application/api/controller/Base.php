<?php

namespace app\api\controller;

use think\Controller;

class Base extends Controller
{
    public function __construct()
    {
        // $this->redis = Cache::store('redis');
    }

    /*
     *获取用户相关信息
     */
    public function getUserAuth()
    {
        return app('user');
    }

    /**
     * 获取用户id
     */
    public function getUserId()
    {

        $auth = $this->getUserAuth();

        return $auth->uid;
    }

}
