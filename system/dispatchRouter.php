<?php
/**
 * Created by PhpStorm.
 * User: wangzhen19
 * Date: 2015/12/31
 * Time: 17:48
 * 路由分发
 */
class dispatchRouter{
    protected $arrUri;
    protected $controllerPath;
    protected $func;


    /**
     * 路由分发入口
     */
    public function dispatch(){
        $this->getUriStr();
        $this->setControllerPath();
        require_once "$this->controllerPath";
        $controller = new controller();
        if (!is_callable(array($controller,$this->func))){
            $this->func = 'defaultMethod';
        }
        $reflection = new ReflectionMethod($controller,$this->func);
        $reflection->invokeArgs($controller,array());
    }

    /**
     * 获取uri query_string的数据形式
     */
    public function getUriStr(){
        $uri = $_SERVER['QUERY_STRING'];
        $uri = trim($uri,'/');
        $uri = empty($uri) ? 'index' : $uri;
        $this->arrUri = explode('/',$uri);
    }

    /**
     * 设置view目录下的controller路径
     */
    public function setControllerPath(){
        $arrUir = array_slice($this->arrUri,0,-1);
        $this->controllerPath = VIEW_PATH.implode('/',$arrUir).'/controller.php';
        $this->func = count($this->arrUri) > 1 ? $this->arrUri[count($this->arrUri) - 1 ] : 'defaultMethod';
        if (!is_readable($this->controllerPath)){
            $this->controllerPath = VIEW_PATH.'default/controller.php';
            $this->func = 'defaultMethod';
        }
    }


}