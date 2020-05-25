<?php

namespace app\index\controller;

use app\index\controller\Base;

class Blog extends Base
{

    public function getBlogList()
    {
        return view('list');
    }

    public function getBlogDetails()
    {
        return view('details');
    }
}
