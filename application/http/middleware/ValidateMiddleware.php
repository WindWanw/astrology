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

        if (isset($header['api-key']) && $header['api-key'] == 'astrology') {

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
