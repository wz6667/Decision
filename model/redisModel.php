<?php
/**
 * Created by PhpStorm.
 * User: wangzhen19
 * Date: 2016/1/9
 * Time: 19:36
 * redis操作基础类
 */
class redisModel{
    protected static $instance = null;
    public static $redis;

    //单例获取mysql实例
    public static function getInstance(){
        if (!self::$instance){
            self::$instance = new redisModel();
        }
        return self::$instance;
    }

    public function __construct(){
        $dbConfig = require CONF_PATH."redis.conf.php";
        self::$redis = new redis();
        $ret =   self::$redis->connect($dbConfig["host"],$dbConfig["port"]);
        if (!$ret){
            log::warning("redis connect error","log.wf");
        }
    }

    public function __destruct(){
        if (self::$redis){
            self::$redis->close();
        }
    }
}