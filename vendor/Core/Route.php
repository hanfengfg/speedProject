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
        $routes = [];
        array_walk($this->routes, function($v, $k) use ($routes){

            $tmpKey = strtolower($k[0] !== '/'? $k:$k = substr($k, 1));
            $tmpValue = strtolower($v[0] !== '/'? $v:$v = substr($v, 1));
            return $k;
        });

        var_dump($this->routes);
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

        $tmpPath = $length ? substr($_SERVER['QUERY_STRING'], 2, $length-2): substr($_SERVER['QUERY_STRING'], 2);
        $tmpPath = explode('/', $tmpPath);

        foreach ($tmpPath as $k=>$v){
            if(!$v){
                unset($tmpPath[$k]);
                continue;
            }
            if(array_reduce(str_split($v),function($sk,$sv){
                if(false !== strpos($this->strBlacklist, $sv) || $sk === true){
                    return true;
                }
                return false;
            })){
                echo 'File not found.';
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