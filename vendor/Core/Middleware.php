<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/23
 * Time: 16:23
 * 寻找当前路由绑定了哪几个中间件
 * 按顺序执行这几个中间件内的方法
 * 首先执行校验方法，检验当前参数是否符合规定（在自定义的中间件类中实现）
 * 其次执行前置方法，对请求数据进行处理（在自定义的中间件类中实现）
 * 最后执行后置方法，对返回数据进行处理（在自定义的中间件类中实现）
 */

namespace Vendor\Core;


class Middleware extends Core
{
    public function __construct()
    {

    }
}