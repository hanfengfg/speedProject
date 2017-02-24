<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/23
 * Time: 16:56
 * 寻找当前路由绑定了哪几个中间件
 * 按顺序执行这几个中间件内的方法
 * 首先执行校验方法，检验当前参数是否符合规定（在自定义的中间件类中实现）
 * 其次执行前置方法，对请求数据进行处理（在自定义的中间件类中实现）
 * 最后执行后置方法，对返回数据进行处理（在自定义的中间件类中实现）
 */

namespace Vendor\Core;




abstract class ControllerFilter extends Core
{
    private $config;
    public function __construct()
    {
        parent::__construct();
        $this->init();
        $this->findFile();
    }

    abstract protected function handle();

    private function init(){
        $this->config = $this->get('filter');
        //$this->middleware = $config['middleware'];
        //->request = $config['request'];
        //$this->response = $config['response'];
    }
    private function findFile(){
        foreach ($this->config as $dir=>$file){
            if(!file_exists(HTTP_PATH.$dir.$file.'.php')){
                throw new \Exception(HTTP_PATH.$dir.$file.'.php file not found');
            }
            foreach ($file as $filterList){
                //判断当前route是否在名单中
                call_user_func_array(array('\\App\\Http\\'.$dir.'\\'.$file, "handle"), $filterList);
            }
        }
    }
    private function getRequest(){

    }
    private function getResponse(){

    }
}