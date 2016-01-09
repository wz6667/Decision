<?php
/**
 * Created by PhpStorm.
 * User: wangzhen19
 * Date: 2015/12/31
 * Time: 17:45
 */
class controller extends controllerBase{
    public function isLogin(){
        if(isset($_SESSION['email'])){
            $result['errNum'] = '0000';
            $result['errMsg'] = errorcode::$error[$result['errNum']];
            $result['email'] = $_SESSION['email'];

        }else{
            $result['errNum'] = '0007';
            $result['errMsg'] = errorcode::$error[$result['errNum']];
        }
        $this->renderJson($result);
    }

    public function getUid(){
       $retID = pass_passService::getUid();
       if ($retID){
           $result['errNum'] = '0000';
           $result['errMsg'] = errorcode::$error[$result['errNum']];
           $result['userId'] = $retID;
       }else{
           $result['errNum'] = '0007';
           $result['errMsg'] = errorcode::$error[$result['errNum']];
       }
        $this->renderJson($result);

    }

}