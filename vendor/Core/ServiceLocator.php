<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/24
 * Time: 15:16
 */

namespace Vendor\Core;


class ServiceLocator extends Container
{

    public function bind($id, $class)
    {
        $this->set($id, $class);
    }

    public function make($id)
    {
        return parent::get($id);
    }
}