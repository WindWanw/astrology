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

use app\facade\Detection;
use app\facade\Image;
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

/**
 * 获取文件绝对地址
 */
if (!function_exists('getFilePath')) {
    function getFilePath($file, $type = "file")
    {
        return Image::getFilePath($file, $type);
    }
}

/**
 * 截取文件
 */
if (!function_exists('setFilePath')) {
    function setFilePath($file, $type = "file")
    {
        return Image::setFilePath($file, $type);
    }
}

/**
 * 时间转换
 *
 * @param  mixed $ts
 *
 * @return void
 */
if (!function_exists('timeFormat')) {
    function timeFormat($time)
    {
        $stamp = [];
        if (is_array($time)) {
            foreach ($time as $k => $v) {
                $stamp[$k] = timeFormat($v);
            }
            return $stamp;
        } else {
            if (strlen($time) > 10) {
                return intval($time / 1000);
            }
            return intval($time);
        }

    }
}

/**
 * 翻译中文为英文
 */
if (!function_exists("translation")) {
    function translation($words, $type = true)
    {
        if (EOC($words) == 'E') {
            return $words;
        }

        $text = json_decode(file_get_contents(config("default.translate_api") . $words))->translateResult[0][0]->tgt;

        return $type ? $text : ucfirst(str_replace(" ", "_", $text));
    }
}

/**
 * 判断字符串是中文还是英文
 */
if (!function_exists("EOC")) {
    function EOC($string)
    {
        $mb = mb_strlen($string, 'utf-8');

        $st = strlen($string);

        if ($st == $mb) {

            return 'E';
        }
        if ($st % $mb == 0 && $st % 3 == 0) {
            return 'C'; //'纯汉字';
        } else {
            return 'EOC'; //'汉英混合';
        }
    }
}

/**
 * 验证字符是否符合规则
 */
if (!function_exists("auto")) {
    function auto($string)
    {
        return Detection::automatic($string);
    }
}
