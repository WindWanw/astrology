<?php

namespace app\common;

use app\util\Code;

class Output
{

    private $show = true;

    /**
     * 输出
     *
     * @param [type] $data
     * @return void
     */
    public function get($data)
    {

        $end = end($data);

        if ($end == 'd') {
            $this->show = false;
        }

        if (in_array($end, ['p', 'd'])) {
            array_pop($data);
        }

        foreach ($data as $k => $v) {
            if (\is_array($data) || \is_object($data)) {
                $this->show ? print_r($v) : var_dump($v);
            } else {
                echo $v;
            }

            echo ',';
        }

    }

    /**
     * 输出格式
     *
     * @param [type] $data      输出内容
     * @param [type] $code      输出code
     * @return void
     */
    public function outPutJson($data, $code)
    {
        if (is_array($data) || \is_object($data)) {
            return json(['code' => $code, 'data' => $data, 'time' => time()]);
        }

        if (is_string($data)) {
            return json(['code' => $code, 'data' => ['message' => $data], 'time' => time()]);
        }

        \exception('Incorrect data type. Use String or Array', Code::ABNORMAL);
    }
}
