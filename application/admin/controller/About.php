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

    public function addAbout()
    {

    }

    public function editAbout()
    {

    }
}
