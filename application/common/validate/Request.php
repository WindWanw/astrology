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
        'pwd' => 'require',
        'nickname' => ['require', 'checkWords'],

        'title' => ['require', 'length' => '0, 50', 'checkWords'],

        'content' => ['require', 'checkWords'],
    ];

    /**
     * 检测不符合规则
     *
     * @param [type] $value
     * @param string $rule
     * @param string $data
     * @param string $field
     * @param string $dec
     * @return void
     */
    protected function checkWords($value, $rule = '', $data = '', $field = '', $dec = '')
    {
        $info = auto($value);

        if (isset($info['error'])) {
            return "出现不符合规则字符，请修改后再次提交!(不规则字符：{$info['error']})";
        } else {
            return $info;
        }
    }

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'    =>    '错误信息'
     *
     * @var array
     */
    protected $message = [
        'username.require' => '账号不能为空',
        'password.require' => '密码不能为空',
        'pwd.require' => '密码不能为空',
        'nickname.require' => '昵称不能为空',
        'title.require' => '标题不能为空',
        'title.length' => '标题最大不能超过50字符',
    ];

    protected $scene = [
        'login' => ['username', 'password'],
        'addWords' => ['title'],
        'aboutInfo' => ['title', 'content'],
        'addUser' => ['username', 'pwd', 'nickname'],
        'editUser' => ['nickname'],
    ];
}
