<?php

namespace app\models;

use app\models\BaseModel;

class SpannerModel extends BaseModel
{

    protected $table = "ast_spanner";

    public function setEnAttr($value, $data)
    {
        if (empty($value)) {
            $en = \translation($data['title']);
        } else {
            $en = $value;
        }

        return \strtoupper($en);

    }

    public function setIconAttr($value)
    {
        return empty($value) ? 'iconlvsefenkaicankaoxianban-' : $value;
    }

    public function setSortAttr($value)
    {
        return empty($value) ? 1 : $value;
    }
}
