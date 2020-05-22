<?php

namespace app\facade;

use think\Facade;

class Output extends Facade
{

    protected static function getFacadeClass()
    {
        return 'app\common\Output';
    }
}
