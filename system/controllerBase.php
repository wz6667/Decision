<?php
/**
 * Created by PhpStorm.
 * User: wangzhen19
 * Date: 2015/12/31
 * Time: 17:43
 * controller基类
 */
class controllerBase{

    public function defaultMethod(){
        require ROOT_PATH."/fe/html/home/home.html";
    }

    //把数组转换成json传给前端
    public function renderJson($val){
        echo json_encode($val);
        die;
    }
}