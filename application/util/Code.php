<?php

namespace app\util;

class Code
{

    const SUCCESS = 0; //成功

    //失败
    const FAIL = 4000;
    const USER_DISABLED = 4001; //用户被禁用
    const DATA_VALIDATE_FAIL = 4002; //数据验证错误
    const TOKEN_FAIL = 4003; //token失效
    const LOGIN_FORBID = 4004; //禁止登录
    const UPLOAD_FILE_FAIL = 4005; //上传文件失败
    const UPLOAD_FILE_MISMATCH = 4006; //上传文件不匹配

    //错误
    const ERROR = 5000;
    const PASSWORD_ERROR = 5001; //密码错误

    //空
    const DATA_EMPTY = 6000;
    const USERNAME_NOT_EXIST = 6001; //用户账号不存在

    //数据异常
    const ABNORMAL = 7000;
    const TOKEN_LENGTH_ABNORMAL = 7001; //token异常
    const KEY_ABNORMAL = 7002; //关键字异常
    const DATA_REPEAT = 7003; //数据重复

    //正常输出
    const NORMAL = 8000;

    const NO_PERMISSION = 9000; //没有权限
}
