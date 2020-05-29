<?php

namespace app\index\controller;

use app\index\controller\Base;
use app\index\model\About as AboutModel;

class About extends Base
{

    public function index()
    {

        $about = AboutModel::with(['profile' => function ($query) {
            $query->field(['user_id', 'name', 'identity']);
        }])->where('status', 1)->all();

        return view('index', ['about' => $about]);
    }
}
