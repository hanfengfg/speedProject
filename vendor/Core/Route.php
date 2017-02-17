<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/16
 * Time: 14:18
 */

namespace Vendor\Core;

class Route extends Core
{

    const URL_MODEL = 0;
    private $host;
    private $path;
    private $params;
    private $routes;
    private $use;
    private $strBlacklist = '!@#$%^~&*()_+|<>?:"{},./;\'[]\\';

    public function __construct()
    {
        parent::__construct();
        $this->getPath();
        $this->registeredRoute();
    }

    private function registeredRoute()
    {

        $this->routes = $this->get('route');
        foreach ($this->routes as $k => $v){
            if (strtolower($k[0] !== '/' ? $k : $k = substr($k, 1)) == $this->path) {
                $this->path = $v;
                break;
            }
        }
        $this->findFile();
        return;
    }

    private function findFile()
    {
        //将当前路由首字母转成大写
        $file = 'IndexController';
        $classFunction = 'index';
        if(!empty($this->path)){
            $tmpPathArr = explode('/', $this->path);
            $count = count($tmpPathArr);
            if(1 == $count){
                $file = ucfirst($tmpPathArr[0]).'Controller.php';
            }else{
                $classFunction = $tmpPathArr[$count-1];
                array_pop($tmpPathArr);
                $file = implode('/', $tmpPathArr);
            }
        }
        //将方法查分出来
        //查询文件是否存在
        $absPath = APP_PATH.'/Http/Controller/'. $file.'.php';
        if(!file_exists($absPath)){
            echo $this->notFoundFilePrompt;
            exit;
        }
        //查询文件内方法是否存在
        $this->findClass($use = '\\App\\Http\\Controller\\'. str_replace('/', '\\', $file), $classFunction);
        return;
    }
    //查找类内方法
    private function findClass($use, $function)
    {
        if(class_exists($use)){
            if(method_exists($use, $function)){
                $this->use = $use;
                return;
            }
        }
        echo $this->notFoundFilePrompt;
        exit;

    }
    private function getHost()
    {
        return $this->host ?: ($this->host = $_SERVER['HTTP_HOST']);
    }

    /*
     * /path1/paths&s=12312?s=222
     */
    private function getPath()
    {
        $length = strpos($_SERVER['QUERY_STRING'], '&');

        $tmpPath = $length ? substr($_SERVER['QUERY_STRING'], 2, $length - 2) : substr($_SERVER['QUERY_STRING'], 2);
        $tmpPath = explode('/', $tmpPath);

        foreach ($tmpPath as $k => $v) {
            if (!$v) {
                unset($tmpPath[$k]);
                continue;
            }
            if (array_reduce(str_split($v), function ($sk, $sv) {
                if (false !== strpos($this->strBlacklist, $sv) || $sk === true) {
                    return true;
                }
                return false;
            })) {
                echo $this->notFoundFilePrompt;
                exit;
            }
        }
        return $this->path ?: ($this->path = strtolower(implode($tmpPath)));
    }

    private function getParams()
    {
        return $this->params ?: ($this->params = $_SERVER['QUERY_STRING']);
    }

    /*
     * 查询文件地址是否存在
     */
    private function findPath()
    {

    }
}