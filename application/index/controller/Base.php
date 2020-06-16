<?php

namespace app\index\controller;

use app\index\model\Spanner;
use app\index\model\User;
use app\util\Enum;
use think\Controller;
use think\facade\Cache;

class Base extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_run();
    }

    public function _run()
    {
        $this->getUserInfo();
        $this->getLanguage();
        $this->getSpanner();

    }

    public function getUserInfo()
    {

        $uid = session('uid');
        //如果session存在
        if ($uid) {

            $user = User::with(['token' => function ($query) {
                $query->field(['user_id', 'expired_time']);
            }])->where('id', $uid)
                ->where('status', Enum::STATUS_TRUE)
                ->find();
            //如果用户token过期
            if (!$user || $user->token->expired_time <= time()) {
                session('uid', null);
                $this->assign('isLogin', false);

            }

            $this->assign(['myUser' => $user, 'isLogin' => true]);

        } else {
            $this->assign('isLogin', false);
        }
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
