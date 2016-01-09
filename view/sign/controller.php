<?php
/**
 * Created by PhpStorm.
 * User: wangzhen19
 * Date: 2016/1/7
 * Time: 12:35
 * 用户注册，登录，登出
 */
class controller extends controllerBase{

    public function signUp(){
        //判断参数是否合法
        $email = $_POST['em'];
        $passwd = $_POST['pass'];
        $email = filter_var($email,FILTER_SANITIZE_EMAIL);
        $regex = '/[^A-Za-z0-9]/';
        if (!filter_var($email,FILTER_VALIDATE_EMAIL) || preg_match($regex,$passwd)|| strlen($passwd) < 6){
            $result['errNum'] = '0006';
            $result['errMsg'] = errorcode::$error[$result['errNum']];
            $this->renderJson($result);
        }

        //写入mysql，并分配一个自增的uid
        $passwd = md5($passwd);
        $userModel = new userModel();
        $ret = $userModel->insert($email,$passwd);
        if (!$ret){
            $result['errNum'] = '0002';
            $result['errMsg'] = errorcode::$error[$result['errNum']];
            $this->renderJson($result);
        }

        $result['errNum'] = '0000';
        $result['errMsg'] = errorcode::$error[$result['errNum']];
        $this->renderJson($result);
    }


    public function loginIn(){
        //判断参数是否合法
        $email = $_POST['em'];
        $passwd = $_POST['pass'];
        $check = $_POST['check'];
        $email = filter_var($email,FILTER_SANITIZE_EMAIL);
        $regex = '/[^A-Za-z0-9]/';
        if (!filter_var($email,FILTER_VALIDATE_EMAIL) || preg_match($regex,$passwd) || strlen($passwd) < 6){
            $result['errNum'] = '0006';
            $result['errMsg'] = errorcode::$error[$result['errNum']];
            $this->renderJson($result);
        }

        //读取mysql
        $userModel = new userModel();
        $passwd = md5($passwd);
        $ret = $userModel->select($email,$passwd);
        $retEmail = null;
        if (is_object($ret)){
            $retEmail = $ret->fetch_array()['email'];
        }
        if (!$ret || !$retEmail){
            $result['errNum'] = '0001';
            $result['errMsg'] = errorcode::$error[$result['errNum']];
            $this->renderJson($result);
        }

        //写入session
        if ($check == "yes"){
            $_SESSION['email'] = $email;
        }

        $result['email'] = $retEmail;
        $result['errNum'] = '0000';
        $result['errMsg'] = errorcode::$error[$result['errNum']];

        $this->renderJson($result);
    }

    public function loginOut(){
       unset($_SESSION['email']);
        session_destroy();
    }

}