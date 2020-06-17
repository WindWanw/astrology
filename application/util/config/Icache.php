<?php

namespace app\util\config;

use app\util\Code;

//缓存相关配置
class Icache
{

    private static $image_cache_position = [

        ['key' => '二维码', 'value' => 'qrcode'],
        ['key' => '上传图片', 'value' => 'upload'],
    ];

    public static function get($key)
    {

        try {

            //动态调用常量
            $value = self::$$key;

            return $value;

        } catch (\Exception $e) {
            \exception("The constant does not exist!(key={$key})", Code::ABNORMAL);

        }

    }
}
