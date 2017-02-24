<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/20
 * Time: 15:18
 */

namespace Vendor\Core;


class Container extends Core
{

    private static $_instance;

    public static $registry;

    public static function getInstance()
    {
        if (!self::$_instance)
        {
            self::$_instance = new Container();
        }

        return self::$_instance;
    }

    public function has($id)
    {
        return isset(static::$registry[$id]);
    }

    public function set($id, $class){
        if(!$this->has($id)){
            static::$registry[$id] = new $class['class']();
        }
    }

    public function get($id){
        if(!$this->has($id)){
            throw new \Exception($id.' not found.');
        }
        return static::$registry[$id];
    }
    public function clear($id){
        unset(static::$registry[$id]);
    }
}