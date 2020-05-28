<?php

namespace app\facade;

use think\Facade;

class Detection extends Facade
{

    protected static function getFacadeClass()
    {
        return 'app\common\Detection';
    }
}
