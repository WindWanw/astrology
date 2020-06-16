<?php

namespace app\api\controller;

use app\api\controller\Base;

class H5 extends Base{

    public function login(){
        return view('h5/login');
    }
}