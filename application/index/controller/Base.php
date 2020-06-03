<?php

namespace app\index\controller;

use app\index\model\Spanner;
use app\util\Enum;
use think\Controller;
use think\facade\Cache;

class Base extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->getLanguage();
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

    public function getLanguage()
    {

        $data = Cache::store('redis')->get(rk('language'));

        $this->assign('language', $data);
    }
}
