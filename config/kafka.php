<?php
// 文件 /config/kafka.php
return [
    // broker列表
    'broker-list' => [
        env("ALY_KAFKA_BROKER_LIST"),
    ],
    'zntk-topic' => env("ALY_KAFKA_ZNTK_TOPIC"),
    'zntk-group_id'      => env("ALY_KAFKA_HDSQ_GROUP_ID"),// 分组id
    /*"kafka-options" => [// sasl_ssl kafka连接方式
        "security.protocol" => "sasl_ssl",
        "sasl.mechanisms" => "PLAIN",
        "api.version.request" => true,
        "sasl.username" => env("ALY_KAFKA_USER_NAME"),
        "sasl.password" => env("ALY_KAFKA_USER_PASS"),
        "ssl.ca.location" => storage_path('config/ca-cert'),// 证书路径
        "offset.store.method" => "broker",// offset保存在broker中
        'group.id'      => env("ALY_KAFKA_ZNTK_GROUP_ID"),// 分组id
    ],*/
    // 在options中不要添加group.id的设置，需要使用消费者列表中的group.id配置
    "kafka-options" => [// sasl_ssl kafka连接方式
        "offset.store.method" => "broker",// offset保存在broker中
    ],
    // 消费者列表
    'client_list' => [
        // 消费客户订货客户客户事件
        'consumer_khdh_client' => [// 消费者客户端id
            'timeout_ms'    => 3000,//(单位毫秒) 消费者等待时间
            'group_id'      => env("ALY_KAFKA_KHDH_CLIENT_GROUP_ID"),// 分组id
            'topic_list'    => [// 主题列表
                env("ALY_KAFKA_KHDH_TOPIC"),
                env('ALY_KAFKA_HDSQ_TOPIC'),
            ],
            'broker_list' => [
                env("ALY_KAFKA_BROKER_LIST"),
            ],
            'event_list'    => [
                // 事件名 => 事件回调函数(必须是静态方法)
                // 下载企业微信媒体文件
                'BBS_DOWNLOAD_QYWX_MEDIA_IDS' => '\App\KafkaEvents\QywxDownloadMediaIds::downloadSaveToMedia',

            ],
        ],
    ],
];