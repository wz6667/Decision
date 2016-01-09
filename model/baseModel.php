<?php
/**
 * Created by PhpStorm.
 * User: wangzhen19
 * Date: 2016/1/7
 * Time: 14:33
 * mysql操作基础类
 */
class baseModel{
    protected static $instance = null;
    protected $mysqli;

    //单例获取mysql实例
    public static function getInstance(){
        if (!self::$instance){
            self::$instance = new baseModel();
        }
        return self::$instance;
    }

    public function __construct(){
        $dbConfig = require CONF_PATH."db.conf.php";
        $this->mysqli = mysqli_init();
        $ret =   $this->mysqli->real_connect($dbConfig["host"],$dbConfig["username"],$dbConfig["password"],$dbConfig["dbname"],$dbConfig["port"]);
        if (!$ret){
            log::warning("mysql connect error","log.wf");
        }
    }

    public function __destruct(){
        if ($this->mysqli){
            $this->mysqli->close();
        }
    }

}