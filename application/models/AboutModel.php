<?php

namespace app\models;

use app\models\BaseModel;

class AboutModel extends BaseModel
{

    protected $table = "ast_about";

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'id');
    }

    public function profile()
    {
        return $this->belongsTo(ProfileModel::class, 'user_id', 'user_id');
    }

    public function setImageAttr($value)
    {
        return setFilePath($value);
    }

    public function getImageAttr($value)
    {
        return getFilePath($value);
    }

    public function getIconAttr($value)
    {
        if (empty($value)) {
            return config('default.default_icon');
        }

        return $value;
    }
}
