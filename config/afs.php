<?php

return [

    /**
     * 调试模式[false-验证，true-不验证，直接返回成功]
     */
    'debug' => env('AFS_DEBUG', false),

    /**
     * CLIENT
     */
    'client' => env('AFS_CLIENT', 'default'),

    /**
     * AFS Clients
     */
    'clients' => [

        /**
         * 默认
         */
        'default' => [
            /**
             * AccessKeyId
             */
            'accessKeyId' => env('AFS_ACCESS_KEY_ID', 'AccessKeyID'),

            /**
             * AccessKeySecret
             */
            'accessKeySecret' => env('AFS_ACCESS_KEY_SECRET', 'AccessKeySecret'),

            /**
             * APPKEY
             */
            'appKey' => env('AFS_APPKEY', 'AppKey'),
        ],

        // 更多客户端...
    ]
];
