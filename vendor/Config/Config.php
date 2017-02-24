<?php
namespace Vendor\Config;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/14
 * Time: 17:54
 */


class Config
{

    public static function get($file)
    {
        if (!file_exists(CONFIG_PATH . $file . '.php')) {
            throw new \Exception(CONFIG_PATH.".$file not found");
        }
        return require_once CONFIG_PATH . $file . '.php';
    }

}