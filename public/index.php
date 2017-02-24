<?php


//自动加载
require __DIR__ . '/../vendor/autoload.php';


defined('ROOT_PATH') || define('ROOT_PATH', __DIR__ . '/../');
defined('APP_PATH') || define('APP_PATH', ROOT_PATH . '/app/');
defined('CONFIG_PATH') || define('CONFIG_PATH', ROOT_PATH . '/config/');
defined('HTTP_PATH') || define('HTTP_PATH', APP_PATH . '/Http/');

//解析路由
$app = new Vendor\Core\Application();

//解析参数

//中间件校验

//分发到指定控制器文件


//返回数据