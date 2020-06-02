<?php

namespace app\index\controller;

use app\index\controller\Base;
use app\index\model\About as AboutModel;

class About extends Base
{

    public function __construct()
    {
        parent::__construct();
        $this->about = AboutModel::getInstance();
    }

    public function index()
    {

        $about = $this->about->with(['user' => function ($query) {
            $query->field(['id', 'nickname']);
        }])->where('status', 1)->all();

        return view('index', ['about' => $about]);
    }
}
