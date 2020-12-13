<?php
return [
    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            'qcloud'
        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
        ],
        'qcloud' => [
            'sdk_app_id' => '1400458202', // SDK APP ID
            'app_key' => '97ec00344bca9c323873c611f8d07f9f', // APP KEY
            'sign_name' => '杨思雨学习记录', // 短信签名，如果使用默认签名，该字段可缺省（对应官方文档中的sign）
        ],
    ],
];
