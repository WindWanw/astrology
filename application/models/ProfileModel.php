<?php

namespace app\models;

use app\models\BaseModel;

class ProfileModel extends BaseModel
{

    protected $table = "ast_profile";

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'id');
    }
}
