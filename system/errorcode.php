<?php
/**
 * Created by PhpStorm.
 * User: wangzhen19
 * Date: 2016/1/7
 * Time: 15:39
 * 错误码
 */
class errorcode{

    public static $error = array(
        '0000' => 'no error',
        '0001' => 'mysql select error',
        '0002' => 'mysql insert error',
        '0003' => 'mysql update error',
        '0004' => 'redis read error',
        '0005' => 'redis write error',
        '0006' => 'param error',
        '0007' => 'not login in',
        '0008' => 'result empty',
    );

    
}