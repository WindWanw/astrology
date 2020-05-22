<?php

namespace app\models;

use think\Model;

class BaseModel extends Model
{
    protected static $instance;

    public static function getInstance()
    {

        if (!static::$instance instanceof static ) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}
