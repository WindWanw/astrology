<?php

namespace app\http\middleware;

use app\facade\Validation;
use app\util\Code;

class ValidateMiddleware
{
    public function handle($request, \Closure $next)
    {

        //验证访问接口是否安全
        $header = $request->header();

        //设置访问接口的来源，如果是来源于外界，则跳转至首页
        if (!isset($header['accept-from']) || $header['accept-from'] == 'index') {
            return \redirect('@index');
        }
        //设置访问接口权限
        if (isset($header['accept-key']) && $header['accept-key'] == 'astrology') {

            //验证数据信息
            $res = Validation::process($request);

            if (isset($res['error'])) {
                return error($res['error'], Code::DATA_VALIDATE_FAIL);
            }
        } else {

            return error('您无权访问该接口！该接口属于私密接口（private）', Code::NO_PERMISSION);
        }

        return $next($request);
    }
}
