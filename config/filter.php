<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/23
 * Time: 17:13
 * 所有文件夹、控制器（无需写Controller）、方法的名称都区分大小写
 * 配置内所表示的根目录在app/Http/Controller下 'app/Http/Controller' = '/'
 * 如果1个方法包含4层处理类
 * 例如Test文件夹下的TestController内的test方法：
 * 'Mida' =>[
        '/'   //对所有Controller处理
    ],
    'Midb' =>[
        'Test',   //对当前目录下的TestController处理
        'Test/'   //对Test文件夹下的所有Controller处理
    ],
    'Midc' => [
        'Index',
        'Test/Test'    //对Test文件夹下的TestController处理
    ],
    'Midd' => [
        'Test/Test/test'    //对Test文件夹下的TestController内的test方法处理
    ]
 * 此方法经过4个中间件处理类 Mida、Midb、Midc、Midd
 * 处理顺序由外层网内层Midc、Midb、Mida、Midd顺序处理
 */


return [

    'Middleware' => [
        'Midc' =>[
            '/'//对所有Controller处理
        ],
        'Midb' =>[
            'Test',//对当前目录下的TestController处理
            'Test/'//对Test文件夹下的所有Controller处理
        ],
        'Mida' => [
            'Index',
            'Test/Test'//对Test文件夹下的TestController处理
        ],
        'Midd' => [
            'Test/Test/test' //对Test文件夹下的TestController内的test方法处理
        ]
    ],
    'Request' => [
        'Reqa'=>[
            '/'
        ],
        'Reqb'=>[
            'Test',
            'Test/'
        ],
        'Reqc'=>[
            'Index'
        ],
    ],
    'Response' => [
        'Resa'=>[
            '/'
        ],
        'Resb'=>[
            'Test',
            'Test/'
        ],
        'Resc'=>[
            'Index'
        ],
    ]
];