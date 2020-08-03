<?php

namespace app\facade;

use think\Facade;

class Qrcode extends Facade
{

    protected static function getFacadeClass()
    {
        return 'app\common\Qrcode';
    }
}
