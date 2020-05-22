<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\Profile;
use app\admin\model\User;
use app\admin\model\UserToken;
use app\facade\Token;
use app\util\Code;
use app\util\Enum;
use think\DB;

class Login extends Base
{

    public function login()
    {

        $data = input();

        $u = User::getInstance();
        $t = UserToken::getInstance();

        $user = $u->where('type', Enum::ADMIN)
            ->where('username', $data['username'])
            ->find();

        if (!$user) {
            return error('账号错误，请重新输入账号', Code::USERNAME_NOT_EXIST);
        }

        if (!password_verify($data["password"], $user->password)) {
            return error('密码错误，请重新输入', Code::PASSWORD_ERROR);
        }

        if (!$user->status) {
            return error('用户账号被禁用', Code::USER_DISABLED);
        }


        try {
            //登录成功则跟新token表
            $t_data = [
                'token' => Token::getToken(config('token.length'), config('token.key')),
                'expired_time' => strtotime("+" . config('token.expired_time') . "day"),
            ];

            $t->where('user_id', $user->id)->update($t_data);

            $u->where('id', $user->id)->update(['login_ip' => \getIpAddress()]);

            $data = $u->with(['user_token' => function ($query) {
                $query->field(['user_id', 'token']);
            }])
                ->field(['id', 'username', 'password', 'nickname', 'avatar'])
                ->find();

            return success(['list' => $data, 'message' => '登录成功']);

        } catch (\Exception $e) {
            return error($e);
        }

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
