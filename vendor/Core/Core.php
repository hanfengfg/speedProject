<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/16
 * Time: 16:16
 */

namespace Vendor\Core;


use Vendor\Config\Config;

class Core
{
    use Config;

    public function __construct()
    {
        $this->init();
    }
}