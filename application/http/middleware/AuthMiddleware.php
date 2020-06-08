<?php

namespace app\http\middleware;

use app\admin\model\User;
use app\admin\model\UserToken;
use app\util\Code;
use think\facade\Request;

class AuthMiddleware
{

    protected $user = [];
    protected $token = [];

    public function handle($request, \Closure $next)
    {
        $token = Request::header('Authorization');

        $this->token = UserToken::where('token', $token)
            ->where('expired_time', '>=', time())
            ->find();

        //是否存在token以及是否存在用户
        if (empty($token) || empty($this->token)) {
            return error('您的登录信息已失效，请重新登录！', Code::TOKEN_FAIL);
        }

        $this->user = User::find($this->token->user_id);

        if (!$this->user->status) {
            return error('用户被禁止登录', Code::LOGIN_FORBID);
        }

        $request->auth = [
            'user_id' => $this->user->id,
        ];

        return $next($request);
    }
}
