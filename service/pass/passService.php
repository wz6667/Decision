<?php
/**
 * Created by PhpStorm.
 * User: wangzhen19
 * Date: 2016/1/9
 * Time: 19:28
 * 注册和登录相关的方法
 */
class pass_passService{

    public static function getUid(){
        if (!isset($_SESSION['email'])){
            return false;
        }

        $userModel = new userModel();
        $ret = $userModel->selectUid($_SESSION['email']);
        if (!is_object($ret)){
            return false;
        }

        $retID = $ret->fetch_array()['userId'];
        if (!$retID){
            return false;
        }

        return $retID;
    }

}