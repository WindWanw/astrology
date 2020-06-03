<?php

namespace app\util;

/**
 * redis的key相关
 */
class Redis
{

    private static $key = 'astrology_';

    const LANGUAGE = 'language'; //语言

    public static function get($str)
    {

        try {

            //动态调用常量
            $value = constant('self::' . strtoupper($str));

            return self::$key . $value;

        } catch (\Exception $e) {
            \exception("The constant does not exist!(key={$str})", Code::ABNORMAL);

        }

    }
}
