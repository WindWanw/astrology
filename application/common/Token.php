<?php

namespace app\common;

use app\util\Code;

class Token
{

    private $key = 'astrology';

    private $length = 32;

    public function getToken($length = 32, $key = '')
    {
        if ($length > $this->length) {
            \exception('token字符长度过长，请重新设置', Code::TOKEN_LENGTH_ABNORMAL);
        }

        $key = empty($key) ? $this->key : $key;

        if (empty(\preg_grep('/[a-zA-Z0-9]{2,}/', [$key]))) {
            \exception('设置的key不符合规则，必须是两位数的大小字母或者数字', Code::KEY_ABNORMAL);
        }

        $length = (!empty($length) && $length > 18) ? $length : $this->length;

        $prefix = \substr($key, 0, 1) . '.'; //token前缀
        $suffix = '.' . \substr($key, -1); //token后缀

        return $prefix . $this->getRandom() . $suffix;
    }

    public function getRandom()
    {

        $string = [
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '~', '.',
            '!', '@', '#', '$', '%', '^', '&', '*', '-', '_', '+', '=', '?',
        ];

        $data = [];

        for ($i = 0; $i < 28; $i++) {

            $length = count($string);

            $key = rand(0, $length-1);

            $data[$i] = $string[$key];
        }

        return implode("",$data);
    }
}
