<?php

namespace app\models;

use app\models\BaseModel;

class YogaModel extends BaseModel
{

    protected $table = "ast_yoga";

    public function getContentAttr($value)
    {
        return array_reverse(\json_decode($value, true));

    }

    public function setContentAttr($value)
    {

        foreach ($value as $k => $v) {
            $value[$k]["time"] = implode("-", $v["time"]);
        }

        return \json_encode($value);
    }
}
