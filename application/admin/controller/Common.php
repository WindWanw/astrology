<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use app\util\Code;

class Common extends Base
{

    /**
     * 文件上传
     *
     * @param string $upload        上传的路径
     * @param string $type          上传文件的类型，不同类型，验证参数不同
     * @return void
     */
    public function uploadFile($open = false, $upload = 'upload_image', $type = "image")
    {

        if ($open == false) {
            return error('您无权访问该接口！该接口属于私密接口（private）', Code::NO_PERMISSION);
        }

        $file = request()->file("file");

        if (!$file) {
            return error("未接收到任何文件，请重新上传", Code::UPLOAD_FILE_FAIL);
        }

        $info = $file->validate(self::checkUploadFile($type))->move(env('root_path') . 'public/static/' . $upload);
        if ($info) {

            $path = \getFilePath('static/' . $upload . '/' . $info->getSaveName());
            switch ($info->getExtension()) {
                case "css":return M\Icon::getInstance()->updateIcon($path);
                    break;
                default:return success(["img" => $path]);
            }

        } else {
            return error(["message" => $file->getError()], Code::UPLOAD_FILE_FAIL);
        }

    }

    /**
     * 返回上传文件的验证信息
     *
     * @param [type] $type
     * @return void
     */
    public static function checkUploadFile($type)
    {

        if (!in_array($type, config('default.default_type'))) {
            exception("该文件类型目前无法上传", Code::UPLOAD_FILE_MISMATCH);
        }

        $size = "default.default_" . $type . "_size";
        $ext = "default.default_" . $type . "_ext";

        return ["size" => config($size), "ext" => config($ext)];

    }
}
