<?php
namespace Vendor\Core;

use Vendor\Config\Config;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/14
 * Time: 17:07
 */
class Application extends ServiceLocator
{
    public function __construct()
    {
        $this->setApplicationConfig();
        $this->register();
    }

    public function register(){
        $register = array_merge($this->defaultRegistrationClass(),$this->componetsRegistrationClass());
        foreach ($register as $k=>$v){
            $this->set($k, $v);
        }
    }
    private function defaultRegistrationClass(){
        return [
            'Route' => [
                'class' => '\Vendor\Core\Route',
            ],
            'Request' =>[
                'class' => '\Vendor\Core\Request',
            ],
            'Controller' => [
                'class' => '\Vendor\Core\Controller',
            ],
            'Response' => [
                'class' => '\Vendor\Core\Response'
            ],
        ];
    }
    private function componetsRegistrationClass(){
        return Config::get('components');
    }
    private function setApplicationConfig(){
        $config = Config::get('application');
        if($config['debug'] === false){
            error_reporting(0);
        }
    }
}