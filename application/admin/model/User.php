<?php

namespace app\admin\model;

use app\models\UserModel;

class User extends UserModel
{

    public function userToken(){
        return $this->hasOne(UserToken::class);
    }
}
