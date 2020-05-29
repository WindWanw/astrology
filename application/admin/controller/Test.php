<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\Profile;
use app\admin\model\User;
use app\admin\model\UserToken;
use app\facade\Token;
use think\DB;

class Test extends Base
{

    public function index()
    {
        // p(config('app.'),'d');

        p(auto('你妈'),'d');
    }

    public function setAdminUser()
    {
        $u = User::getInstance();
        $t = UserToken::getInstance();
        $p = Profile::getInstance();

        $u_data = [
            'username' => 'admin',
            'password' => \password_hash('123456', PASSWORD_DEFAULT),
            'pwd' => '123456',
            'nickname' => 'admin',
            'reg_ip' => \getIpAddress(),
            'status' => 1,
            'type' => 1,
        ];

        // 启动事务
        Db::startTrans();

        if ($user = $u->create($u_data)) {

            $t_data = [
                'user_id' => $user->id,
                'token' => Token::getToken(),
                'expired_time' => strtotime('+' . config('token.expired_time') . 'day'),
            ];

            if (!$t->create($t_data)) {
                Db::rollback();
                return error('t');
            }

            $p_data = [
                'user_id' => $user->id,
            ];

            if (!$p->create($p_data)) {
                Db::rollback();
                return error('p');

            }

            // 提交事务
            Db::commit();
            return success('添加成功');

        } else {
            Db::rollback();

        }

        return error('u');

        // return error('添加失败');

    }
}
