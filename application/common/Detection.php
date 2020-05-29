<?php

namespace app\common;

use app\models\WordListModel as W;
use app\util\Enum;

/**
 * 检测文字
 */
class Detection
{

    /**
     * 获取黑名单
     *
     * @return void
     */
    public function getBlackWords()
    {

        return W::where('type', Enum::BLACK_TYPE)->field(['title'])->all()->toArray();
    }

    /**
     * 自动筛选是否存在黑名单中数据
     *
     * @param [type] $text      被检测内容
     * @return void
     */
    public function automatic($text)
    {
        if (empty($text)) {
            return true;
        }

        $words = $this->getBlackWords();

        if (empty($words)) {
            return true;
        }

        foreach ($words as $key => $value) {
            if (strpos($text, $value['title']) !== false) {
                return ['error' => $value['title']];
            }

        }

        return true;
    }
}
