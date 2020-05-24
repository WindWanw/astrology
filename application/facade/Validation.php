<?php

namespace app\facade;

use think\Facade;

class Validation extends Facade
{

    protected static function getFacadeClass()
    {
        return 'app\common\Validation';
    }
}