<?php

namespace app\facade;

use think\Facade;

class Token extends Facade
{

    protected static function getFacadeClass()
    {
        return 'app\common\Token';
    }
}
