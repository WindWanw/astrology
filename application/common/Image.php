<?php

namespace app\common;

class Image
{

    /**
     * 处理文件类型，转成数组
     *
     * @param [type] $file
     * @return void
     */
    public function setJsonDecode($file)
    {
        if (!is_string($file)) {
            return $file;
        }

        $data = json_decode($file);

        return (json_last_error() == JSON_ERROR_NONE) ? $data : $file;
    }

    /**
     * 处理文件
     *
     * @param string $file
     * @return void
     */
    public function getFilePath($file, $type = "file")
    {
        if (empty($file) || !$file) {
            return $this->getDefaultImage($type);
        }

        $file = $this->setJsonDecode($file);

        if (is_iterable($file)) { //判断数据是否是可迭代
            return array_map("getFilePath", $file);
        }

        if (stripos($file, "\\") !== false) {
            $file = str_replace("\\", "/", $file);
        }

        if (stripos($file, "http") === false && stripos($file, "https") === false) {
            $file = config("default.default_host") . $file;
        }

        return $file;
    }

    /**
     * 设置文件路径，截去host
     *
     * @param [type] $file
     * @return void
     */
    public function setFilePath($file, $type = "file")
    {
        if (empty($file) || !$file) {
            return $this->getDefaultImage($type);
        }
        $file = $this->setJsonDecode($file);

        if (is_iterable($file)) { //判断数据是否是可迭代
            return array_map("setFilePath", $file);
        }

        if (stripos($file, "\\") !== false) {
            $file = str_replace("\\", "/", $file);
        }

        if (stripos($file, config("default.default_host")) !== false) {
            $file = str_replace(config("default.default_host"), "", $file);
        }

        return $file;
    }

    /**
     * 根据类型获取默认的图片
     *
     * @param [type] $type
     * @return void
     */
    public function getDefaultImage($type)
    {

        $default_type = ["avatar", "img", "image", "pic"];

        if (!in_array($type, $default_type)) {
            return "";
        }

        switch ($type) {
            case "avatar":
                $img = config('default.default_avatar');
                break;
            case "img":
                $img = config('default.default_image');
                break;
            case "image":
                $img = config('default.default_image');
                break;
            case "pic":
                $img = config('default.default_image');
                break;
            default:$img = config('default.default_image');
        }

        return config("default.default_host") . $img;
    }
}
