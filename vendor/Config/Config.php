<?php
namespace Vendor\Config;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/14
 * Time: 17:54
 */
use Exception;

trait Config
{
    private $configPath;
    protected $config = [];

    protected function init()
    {
        $this->configPath = __DIR__ . '/../../config/';
    }

    protected function get($file)
    {
        if (!file_exists($this->configPath . $file . '.php')) {
            throw new Exception("$this->configPath.$file not found");
        }
        return require_once $this->configPath . $file . '.php';
    }
}