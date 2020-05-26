<?php

namespace app\facade;

use think\Facade;

class Image extends Facade
{

    protected static function getFacadeClass()
    {
        return 'app\common\Image';
    }
}
