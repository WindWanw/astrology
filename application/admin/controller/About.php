<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\About as AboutModel;

class About extends Base
{

    public function getAboutList()
    {
        $query = AboutModel::with('user');

        $list = $query->all();
        $count = $query->count();

        return success(['list' => $list, 'total' => $count]);
    }

    public function addAboutInfo()
    {
        $data = input();
        $data['user_id']=$this->getUserId();

        if (AboutModel::create($data)) {
            return success('添加成功');
        }

        return error('添加失败');
    }

    public function editAboutInfo()
    {

    }
}
