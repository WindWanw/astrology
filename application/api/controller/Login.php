<?php

namespace app\api\controller;

use app\api\controller\Base;
use app\api\model\Profile;
use app\api\model\User;
use app\api\model\UserToken;
use app\facade\Token;
use app\util\Code;
use app\util\Enum;

class Login extends Base
{

    public function __construct()
    {
        parent::__construct();

        $this->user = User::getInstance();
        $this->token = UserToken::getInstance();
        $this->profile = Profile::getInstance();
    }

    public function login()
    {
        //根据username查找账号/电话号码/邮箱查找用户
        $user = $this->user
            ->hasWhere('profile', function ($query) {
                $query->where('phone|email', input('username'));
            })
            ->where('type', Enum::INDEX)
            ->whereOr(function ($query) {
                $query->where(['username' => input('username'), 'type' => Enum::INDEX]);
            })
            ->find();

        if (!$user) {
            return error('账号错误，请重新输入账号', Code::USERNAME_NOT_EXIST);
        }

        if (!password_verify(input("password"), $user->password)) {
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

            $this->token->where('user_id', $user->id)->update($t_data);

            $this->user->where('id', $user->id)->update(['login_ip' => \getIpAddress()]);

            $data = $this->token->where('user_id', $user->id)->field('token')->find();

            return success(['list' => $data, 'message' => '登录成功']);

        } catch (\Exception $e) {
            return error($e);
        }

    }

    /**
     * 获取用户信息
     *
     * @return void
     */
    public function getUserInfo()
    {

        $user = $this->user->with('profile')->find($this->getUserId());

        return success($user);
    }
}
