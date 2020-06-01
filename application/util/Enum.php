<?php

namespace app\util;

class Enum
{
    //登录
    const INDEX = 0; //前台用户
    const ADMIN = 1; //后台用户

    //words黑白名单
    const WHITE_TYPE = 1; //白名单类型
    const BLACK_TYPE = 2; //黑名单类型

    //前后台用户类型
    const USER_TYPE_ADMIN = 1; //后台
    const UERR_TYPE_INDEX = 0; //前台
}
