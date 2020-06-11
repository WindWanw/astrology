<?php

namespace app\api\controller;

use app\api\controller\Base;
use app\api\model\Profile;
use app\api\model\User;
use app\api\model\UserToken;
use app\util\Enum;

class Login extends Base
{

    public function __construct()
    {
        parent::__construct();

        $this->user = User::getInstance();
        $this->token = UserToken::getInstance();
        $this->profile = Profile::getInstance();
    }

    public function login()
    {
        $user=$this->user->hasWhere(['profile'=>function($query){

        }])->orWhere()->where('type',Enum::INDEX)->get();
    }
}
