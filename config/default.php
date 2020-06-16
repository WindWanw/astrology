<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Wanwei <2438001922@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 默认设置
// +----------------------------------------------------------------------

//返回域名
function getDefaultHost()
{
    //配置本地域名
    $local_host = ['www.ast.gold.com'];

    $host = request()->host();

    if (in_array($host, $local_host)) {
        return 'http://' . $host . '/';
    }

    return "http://www.ast.gold/";

}

return [
    //默认域名
    "default_host" => getDefaultHost(),
    //默认头像
    "default_avatar" => "/static/default/avatar.jpg",
    //默认图片
    "default_image" => "/static/default/image.jpg",
    //标志图片
    "default_sign" => '/static/default/sign.jpg',
    //默认上传类型
    "default_type" => ["image", "file", "audio"],
    //默认上传图片大小(2M)
    "default_image_size" => 2097152,
    //默认上传图片后缀
    "default_image_ext" => "jpg,png,gif,icon,svg",
    //默认上传文件大小(10M)
    "default_file_size" => 10485760,
    //默认上传文件后缀
    "default_file_ext" => "doc,txt,wps,xls,ppt,rar,zip,pdf,css",
    //默认上传音频文件大小(50M)
    "default_audio_size" => 52428800,
    //默认上传音频文件后缀
    "default_audio_ext" => "mp3,avi,swf",
    //默认邮箱
    "default_email_suffix" => ["qq", "163", "126", "sina", "sohu"],
    //翻译api
    "translate_api" => "http://fanyi.youdao.com/translate?&doctype=json&type=AUTO&i=",
    //默认通用接口action,小写
    "default_action" => ["uploadfile", "getwxqrcode"],
    //默认图标
    "default_icon" => 'iconlvsefenkaicankaoxianban-',
];
