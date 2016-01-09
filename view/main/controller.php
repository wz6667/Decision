<?php
/**
 * Created by PhpStorm.
 * User: wangzhen19
 * Date: 2016/1/7
 * Time: 20:01
 */
class controller extends controllerBase{
    const REDIS_DECISION_USER_KEY = "decision_user_%s";

    public function showMain(){
        require ROOT_PATH."/fe/html/main/main.html";
    }

    public function storeContent(){
        $name = $_POST['name'];
        $final = $_POST['final'];
        $advantages = $_POST['ad'];
        $disadvantages = $_POST['dis'];
        $retID = pass_passService::getUid();
        if (!$retID){
            $result['errNum'] = '0007';
            $result['errMsg'] = errorcode::$error[$result['errNum']];
            $this->renderJson($result);
        }
        $content = array('name' => $name,
            'final' => $final,
            'ad' => $advantages,
            'dis' => $disadvantages,
        );
        $redis = redisModel::getInstance();
        $key = sprintf(self::REDIS_DECISION_USER_KEY,$retID);
        $ret = $redis::$redis->lPush($key,json_encode($content));
        if (!$ret){
            log::warning("redis write error","log.wf");
            $result['errNum'] = '0005';
            $result['errMsg'] = errorcode::$error[$result['errNum']];
            $this->renderJson($result);
        }

        $result['errNum'] = '0000';
        $result['errMsg'] = errorcode::$error[$result['errNum']];
        $this->renderJson($result);
    }
}