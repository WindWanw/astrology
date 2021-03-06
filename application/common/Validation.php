<?php

namespace app\common;

class Validation
{

    //对应验证器关系
    //模块.控制器.方法=>验证器类.场景
    //key必须是字符小写
    protected $validator = [

        //登录
        'admin.login.login' => 'Request.login',
        //添加名单（黑白）
        'admin.system.addwords' => 'Request.addWords',
        //关于我们
        'admin.about.addaboutinfo' => 'Request.aboutInfo',
        'admin.about.editaboutinfo' => 'Request.aboutInfo',

        //后台用户
        'admin.user.adduserinfo' => 'Request.addUser',
        'admin.user.edituserinfo' => 'Request.editUser',

        //导航
        'admin.system.addspannerinfo' => 'Request.addSpanner',
        'admin.system.editspannerinfo' => 'Request.editSpanner',

        //api模块
        'api.login.login' => 'Request.login',
    ];

    /**
     * 获取当前路由的模块.控制器.方法
     */
    private function getRouteName($request)
    {

        return strtolower($request->module() . '.' . $request->controller() . '.' . $request->action());
    }

    public function process($request)
    {

        $name = $this->getRouteName($request);

        //查看是否设置了验证对应关系
        if (isset($this->validator[$name])) {

            //获取验证器
            $validate = $this->validator[$name];

            //把验证器类名和场景解析出来
            list($class_name, $scene) = \explode(".", $validate);

            //验证器类
            $className = 'app\\common\\validate\\' . $class_name;

            //如果该验证器类没有定义，也不做任何校验
            if (class_exists($className) === false) {
                return true;
            }

            $v = new $className();

            if (!$v->scene($scene)->check($request->param())) {

                return ['error' => $v->getError()];
            }
        }

        return true;
    }

}
