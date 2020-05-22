<?php

namespace app\models;

use app\models\BaseModel;

class UserModel extends BaseModel
{
    protected $table = "ast_user";

    public function userToken()
    {
        return $this->hasOne(UserTokenModel::class, 'user_id', 'id');
    }
}
