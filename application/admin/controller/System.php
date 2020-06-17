<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\Spanner;
use app\admin\model\System as SY;
use app\admin\model\WordList;
use app\util\Code;
use app\util\config\Icache;

class System extends Base
{

    public function __construct()
    {
        parent::__construct();
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

    /**
     *添加导航信息
     *
     * @return void
     */
    public function addSpannerInfo()
    {
        $data = input();

        if ($this->spanner->getByTitle(input('title'))) {
            return error('导航名称重复', Code::DATA_REPEAT);
        }

        if ($this->spanner->allowField(true)->save($data)) {
            return success('添加成功');
        }

        return error('添加失败');
    }

    /**
     * 修改导航信息
     *
     * @return void
     */
    public function editSpannerInfo()
    {
        $data = input();

        if ($this->spanner->where('title', input('title'))->where('id', '<>', input('id'))->find()) {
            return error('导航名称重复', Code::DATA_REPEAT);

        }

        if ($this->spanner->allowField(true)->save($data, input('id'))) {
            return success('修改成功');
        }

        return error('修改失败');
    }

    /**
     * 设置语言
     *
     * @return void
     */
    public function setIndexLanguage()
    {

        if ($this->redis->set(rk('language'), input('language'))) {
            return success(['message' => '设置成功', 'data' => $this->redis->get(rk('language'))]);
        }

        return error('设置失败');

    }

    /**
     * 获取设置的语言
     *
     * @return void
     */
    public function getIndexLanguage()
    {

        return success(['data' => $this->redis->get(rk('language'))]);
    }

    /**
     * 获取图片缓存类型
     *
     * @return void
     */
    public function getImageCacheType()
    {
        return success(Icache::get('image_cache_position'));
    }

    /**
     * 清除图片缓存
     *
     * @return void
     */
    public function clearImageCache()
    {
        $type = input('type');

        foreach ($type as $key => $value) {

            switch ($value) {
                case 'qrcode':
                    SY::clearQrcodeImageCache('./static/qrcode/');
                    break;
                case 'image':
                    SY::clearUploadImageCache();
                    break;
            }
        }

        return success('清除缓存成功');

    }
}
