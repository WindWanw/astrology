<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

use app\facade\Output;
use app\util\Code;

/**
 * 打印
 */
if (!function_exists('p')) {
    function p(...$data)
    {
        return Output::get($data);
    }
}

/**
 * 成功输出
 */
if (!function_exists('success')) {
    function success($data, $code = Code::SUCCESS)
    {
        return Output::outPutJson($data, $code);
    }
}

/**
 * 失败输出
 */
if (!function_exists('error')) {
    function error($data, $code = Code::FAIL)
    {
        return Output::outPutJson($data, $code);
    }
}

/*
 * 获取IP地址
 */
if (!function_exists('getIpAddress')) {
    function getIpAddress()
    {
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (!empty($_SERVER["REMOTE_ADDR"])) {
            $cip = $_SERVER["REMOTE_ADDR"];
        } else {
            $cip = "127.0.0.1";
        }
        return $cip;
    }

}
