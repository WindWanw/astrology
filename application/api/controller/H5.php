<?php

namespace app\api\controller;

use app\api\controller\Base;
use app\api\model\Yoga;

class H5 extends Base
{

    public function login()
    {
        return view('h5/login');
    }

    public function yj()
    {
        return view('h5/yj');
    }

    public function yoga()
    {
        return view('h5/yoga');
    }

    public function getYogaList()
    {

        $y = Yoga::getInstance();

        if ($list = $y->find(input("id"))) {
            return success($list);
        }

        return error("响应错误");
    }
}
