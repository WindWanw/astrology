<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\About as AboutModel;

class About extends Base
{

    
    public function __construct()
    {
        $this->about = AboutModel::getInstance();
    }

    /**
     * 关于我们列表
     */
    public function getAboutList()
    {
        $list = $this->about->with('user')->paginate(input('limit'));
        
        return success($list);
    }

    /**
     * 添加关于我们内容
     */
    public function addAboutInfo()
    {
        $data = input();
        $data['user_id'] = $this->getUserId();

        if ($this->about->allowField(true)->save($data)) {
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

        if ($this->about->allowField(true)->save($data, ['id' => input('id')])) {
            return success('更新成功');
        }

        return error('更新失败');
    }
}
