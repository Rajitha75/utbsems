<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 1200,
        ],
        'awssdk' => [
            'class' => 'fedemotta\awssdk\AwsSdk',
            'credentials' => [ //you can use a different method to grant access
                'key' => 'AKIAIJCFA6QKGPZTEDOA',
                'secret' => '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',
            ],
            'region' => 'ap-south-1', //i.e.: 'us-east-1'
            'version' => 'latest', //i.e.: 'latest'
        ],
    ],
    
];
