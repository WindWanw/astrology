<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\Spanner;
use app\admin\model\WordList;

class System extends Base
{

    public function __construct()
    {

        $this->word = WordList::getInstance();
        $this->spanner = Spanner::getInstance();
    }

    /**
     * 获取字符列表
     *
     * @return void
     */
    public function getWordsList()
    {
        $list = $this->word->all();

        $white = [];
        $black = [];
        foreach ($list as $key => $value) {
            if ($value->type == 1) {
                $white[] = $value;
            } else {
                $black[] = $value;
            }
        }

        return success(['white' => $white, 'black' => $black]);

    }

    /**
     * 设置字符的黑白名单
     *
     * @return void
     */
    public function addWords()
    {

        $data = input();

        if ($this->word->allowField(true)->save($data)) {
            return success('添加成功');
        }

        return error('添加失败');
    }

    /**
     * 修改字符名单
     *
     * @return void
     */
    public function editWords()
    {

        if ($this->word->allowField(true)->save(['title' => input('title')], ['id' => input('id')])) {
            return success('修改成功');
        }

        return error('修改失败');
    }

    /**
     * 删除字符名单
     *
     * @return void
     */
    public function delWords()
    {
        if ($this->word->get(input('id'))->delete()) {
            return success('删除成功');
        }

        return error('删除失败');
    }

    /**
     * 获取前台导航信息
     *
     * @return void
     */
    public function getSpannerList()
    {
        $list = $this->spanner->paginate(input('limit'));

        return success($list);
    }

    public function addSpannerInfo()
    {

    }

    public function editSpannerInfo()
    {

    }
}
