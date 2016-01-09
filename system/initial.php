<?php
/**
 * Created by PhpStorm.
 * User: wangzhen19
 * Date: 2015/12/31
 * Time: 14:56
 * 后端php框架初始化文件
 */

//1 定义系统常量
define('ROOT_PATH',dirname(__FILE__).'/../');
define('CONF_PATH',ROOT_PATH.'conf/');
define('SYSTEM_PATH',ROOT_PATH.'system/');
define('MODEL_PATH',ROOT_PATH.'model/');
define('SERVICE_PATH',ROOT_PATH.'service/');
define('VIEW_PATH',ROOT_PATH.'view/');
define('WEBROOT_PATH',ROOT_PATH.'webroot/');

//2定义类自动加载
function loadClass($className = ''){
    $arrName = explode("_",$className);
    $strClassPath = implode(DIRECTORY_SEPARATOR,$arrName).".php";
    $filePaths[] = MODEL_PATH.$strClassPath;
    $filePaths[] = SERVICE_PATH.$strClassPath;
    $filePaths[] = SYSTEM_PATH.$strClassPath;
    foreach ($filePaths as $fp) {
        if (is_file($fp)){
            require_once($fp);
            break;
        }
    }
}
spl_autoload_register('loadClass');

session_name('Decision');
session_start();


//3.路由分发，找到所有view目录下的controller
$dispatch = new dispatchRouter();
$dispatch->dispatch();


