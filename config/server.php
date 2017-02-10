<?php


//$server = new \swoole_server($host, $port, $mode = SWOOLE_PROCESS, $sock_type = SWOOLE_SOCK_TCP);

return [

    'construct_config' => [
        /*
         * 用来指定监听的ip地址，如127.0.0.1，或者外网地址，或者0.0.0.0监听全部地址
         * IPv4使用 127.0.0.1表示监听本机，0.0.0.0表示监听所有地址
         * IPv6使用::1表示监听本机，:: (0:0:0:0:0:0:0:0) 表示监听所有地址
         */
            'host' => '0.0.0.0',



            /*
             * 监听的端口，如9501，监听小于1024端口需要root权限，如果此端口被占用server->start时会失败
             */
            'port' => 9501
    ],
    'set_config' => [
        /*
     * 设置启动的worker进程数。
     * 业务代码是全异步非阻塞的，这里设置为CPU的1-4倍最合理
     * 业务代码为同步阻塞，需要根据请求响应时间和系统负载来调整
     * 比如1个请求耗时100ms，要提供1000QPS的处理能力，那必须配置100个进程或更多。但开的进程越多，占用的内存就会大大增加，而且进程间切换的开销就会越来越大。所以这里适当即可。不要配置过大。
     * 每个进程占用40M内存，那100个进程就需要占用4G内存
     */
        'worker_num' => 5,

        /*
         * 配置task进程的数量，配置此参数后将会启用task功能。所以swoole_server务必要注册onTask/onFinish2个事件回调函数。如果没有注册，服务器程序将无法启动。
         * task进程是同步阻塞的，配置方式与worker同步模式一致。
         * 计算方法
         * 单个task的处理耗时，如100ms，那一个进程1秒就可以处理1/0.1=10个task
         * task投递的速度，如每秒产生2000个task
         * 2000/10=200，需要设置task_worker_num => 200，启用200个task进程
         */
        'task_work_num' => 5,


        /*
         * 1, 使用unix socket通信，默认模式
         * 2, 使用消息队列通信
         * 3, 使用消息队列通信，并设置为争抢模式
         */
        'task_ipc_mode' => 1,



        'package_max_length' => 8388608,



        'max_requests' => 65535,



        /*
         * 守护进程化。设置daemonize => 1时，程序将转入后台作为守护进程运行。长时间运行的服务器端程序必须启用此项。
         * 如果不启用守护进程，当ssh终端退出后，程序将被终止运行。
         * 启用守护进程后，标准输入和输出会被重定向到 log_file
         * 如果未设置log_file，将重定向到 /dev/null，所有打印屏幕的信息都会被丢弃
         */
        'daemonize' => 0,



        /*
         * log_file => '/data/log/swoole.log', 指定swoole错误日志文件。在swoole运行期发生的异常信息会记录到这个文件中。默认会打印到屏幕。
         * 注意log_file不会自动切分文件，所以需要定期清理此文件。观察log_file的输出，可以得到服务器的各类异常信息和警告。
         * log_file中的日志仅仅是做运行时错误记录，没有长久存储的必要。
         * 开启守护进程模式后(daemonize => true)，标准输出将会被重定向到log_file。在PHP代码中echo/var_dump/print等打印到屏幕的内容会写入到log_file文件
         * 日志标号
         *   在日志信息中，进程ID前会加一些标号，表示日志产生的线程/进程类型。
         *   # Master进程
         *   $ Manager进程
         *   * Worker进程
         *   ^ Task进程
         */
        'log_file' => '/var/log/swoole.log',
    ]
];
