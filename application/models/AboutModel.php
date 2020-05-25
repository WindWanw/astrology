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
}
