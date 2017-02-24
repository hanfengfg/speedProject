<?php
return [

    'memcached' => [
        'class' => '\Vendor\Cache\Memcached',
        'host' => '127.0.0.1',
        'port' => 11211,
        'prefix' => 'speed_'
    ],
    'redis' => [
        'class' => '\Vendor\Cache\Redis',
        'host' => '127.0.0.1',
        'port' => 6379,
        'prefix' => 'speed_'
    ]
];
