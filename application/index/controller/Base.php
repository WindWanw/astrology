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

        $host = [
            'ast.gold',
            'www.ast.gold',
        ];

        if (in_array($_SERVER['HTTP_HOST'], $host)) {
            $data = Cache::store('redis')->get(rk('language'));

        } else {
            $data = 'en-US';
        }

        $this->assign('language', $data);
    }
}
