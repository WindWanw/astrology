<?php

return [

    'expired_time' => 7, //token的过期时间
    'key' => '', //生成token的关键字,为空则默认使用token类中的属性key
    'length' => 32, //生成token的位数，为空默认使用token类中的属性length
];
