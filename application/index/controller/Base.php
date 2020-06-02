<?php

namespace app\index\controller;

use app\index\model\Spanner;
use app\util\Enum;
use think\Controller;

class Base extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->getSpanner();
    }

    public function getSpanner()
    {
        $spanner = Spanner::getInstance()->where('status', Enum::STATUS_TRUE)
            ->order(['id', 'sort'])
            ->field(['id', 'title', 'en', 'icon', 'url'])
            ->all();

        $this->assign('spanner', $spanner);
    }
}
