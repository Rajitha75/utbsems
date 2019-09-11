<?php

if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {

    // this is HTTPS
    $protocol  = "https";
} else {
    // this is HTTP
    $protocol  = "http";
}


$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '_ZgA9_Xay7tu-pIRjoJCJOtg8PGryas-',
        ],
        'session' => [
            'class' => 'yii\web\DbSession',            
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/',
            ],
        ],
        'urlManagerFrontend' => [
                'class' => 'yii\web\urlManager',
                'baseUrl' => $protocol.'://'.$_SERVER['HTTP_HOST'],//i.e. $_SERVER['DOCUMENT_ROOT'] .'/yiiapp/web/'
                'enablePrettyUrl' => true,
                'showScriptName' => false,
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
  //  $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
    //$config['layout'][] = '@web/themes/metronic/views/layouts/main';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
