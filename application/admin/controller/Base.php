<?php

namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{

    public function __construct()
    {
        
    }

    /*
     *获取用户相关信息
     */
    public function getUserAuth()
    {
        return request()->auth;
    }

    /**
     * 获取用户id
     */
    public function getUserId()
    {

        $auth = $this->getUserAuth();

        return $auth['user_id'];
    }
}
