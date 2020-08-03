<?php

namespace app\index\controller;

use app\index\controller\Base;

class Shop extends Base
{

    public function getShopList()
    {
        return view('list');
    }

    public function getShopDetails()
    {
        return view('details');
    }
}
