<?php

namespace app\models;

use app\models\BaseModel;

class UserModel extends BaseModel
{
    protected $table = "ast_user";

    public function user_token()
    {
        return $this->hasOne(UserTokenModel::class, 'user_id', 'id');
    }
}
