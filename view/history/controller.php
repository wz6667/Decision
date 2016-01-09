<?php
/**
 * Created by PhpStorm.
 * User: wangzhen19
 * Date: 2016/1/9
 * Time: 1:16
 */
class controller extends controllerBase{
    const REDIS_DECISION_USER_KEY = "decision_user_%s";
    public function showHistory(){
        require ROOT_PATH."/fe/html/history/history.html";
    }

    public function getContent(){
        $retID = pass_passService::getUid();
        if (!$retID){
            $result['errNum'] = '0007';
            $result['errMsg'] = errorcode::$error[$result['errNum']];
            $this->renderJson($result);
        }

        $redis = redisModel::getInstance();
        $key = sprintf(self::REDIS_DECISION_USER_KEY,$retID);
        $ret = $redis::$redis->lRange($key,0,9);
        foreach ($ret as $key => $value) {
            $ret[$key] = json_decode($value,true);
        }

        if(empty($ret)){
            $result['errNum'] = '0008';
            $result['errMsg'] = errorcode::$error[$result['errNum']];
            $this->renderJson($result);
        }

        $result['errNum'] = '0000';
        $result['errMsg'] = errorcode::$error[$result['errNum']];
        $result['content'] = $ret;
        $this->renderJson($result);
    }
}