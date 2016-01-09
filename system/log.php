<?php
/**
 * Created by PhpStorm.
 * User: wangzhen19
 * Date: 2016/1/7
 * Time: 16:35
 * 打印日志
 */
class log{
    public static function notice($logContent,$mod){
        self::writeFile($logContent,$mod,"notice");
    }

    public static function warning($logContent,$mod){
        self::writeFile($logContent,$mod,"warning");
    }

    public static function writeFile($content,$mod,$level){
        $date = date('Y/m/d H:i:s',time());
        $bt = debug_backtrace();
        $file = $bt[0]['file'];
        $line = $bt[0]['line'];
        $content = "$level: $date $file $line $content\n";
        $dir = ROOT_PATH.'log/';
        if (! is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        $mod = $dir.$mod;
        file_put_contents($mod,$content,FILE_APPEND);
    }

}