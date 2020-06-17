<?php

namespace app\admin\model;

class System
{

    public static function clearQrcodeImageCache($path)
    {
        $date = date("Ymd", time());

        //判断是否是目录
        if (is_dir($path)) {

            //扫描一个文件夹内的所有文件夹和文件并返回数组
            $p = scandir($path);

            foreach ($p as $value) {

                //排除目录中的.和..
                if ($value != "." && $value != ".." && $value != $date) {

                    $path_child = $path . $value . '/';

                    //如果是目录则递归子目录，继续操作
                    if (is_dir($path_child)) {

                        //子目录中操作删除文件夹和文件
                        self::clearQrcodeImageCache($path_child);

                        //目录清空后删除空文件夹
                        return @rmdir($path_child);
                    } else {
                        //如果是文件直接删除
                        return \unlink($path . $value);
                    }
                }
            }
        }

    }

    public static function clearUploadImageCache()
    {
        return true;
    }

}
