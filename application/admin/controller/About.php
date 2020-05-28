<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\About as AboutModel;

class About extends Base
{

    /**
     * 关于我们列表
     */
    public function getAboutList()
    {
        $query = AboutModel::with('user');

        $list = $query->all();
        $count = $query->count();

        return success(['list' => $list, 'total' => $count]);
    }

    /**
     * 添加关于我们内容
     */
    public function addAboutInfo()
    {
        $data = input();
        $data['user_id'] = $this->getUserId();

        if (AboutModel::create($data)) {
            return success('添加成功');
        }

        return error('添加失败');
    }

    /**
     * 修改
     */
    public function editAboutInfo()
    {
        $data = [
            'title' => input('title'),
            'content' => input('content'),
            'image' => input('image'),
            'status' => input('status'),
        ];

        if (AboutModel::where('id', input('id'))->update($data)) {
            return success('更新成功');
        }

        return error('更新失败');
    }
}
