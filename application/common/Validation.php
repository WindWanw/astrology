<?php

namespace app\common;

class Validation{

    //对应验证器关系
    protected $validator=[

    ];

    /**
     * 获取当前路由的模块.控制器.方法
     */
    private function getRouteName($request){

        return strtolower($request->module().'.'.$request->controller().'.'.$request->action());
    }


    public function process($request){

        $name=$this->getRouteName($request);

        p($request->header()['api-key'],$name);die;
    }

}