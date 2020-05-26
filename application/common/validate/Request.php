<?php

namespace app\common\validate;

use think\Validate;

class Request extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'    =>    ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'username' => 'require',
        'password' => 'require',

        'title' => ['require', 'max' => 50],
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'    =>    '错误信息'
     *
     * @var array
     */
    protected $message = [
        'username.require' => '账号不能为空',
        'password.require' => '密码不能为空',
        'title.require' => '标题不能为空',
        'title.max' => '标题最大不能超过50字符',
    ];

    protected $scene = [
        'login' => ['username', 'password'],
        'addWords' => ['title'],
    ];
}
