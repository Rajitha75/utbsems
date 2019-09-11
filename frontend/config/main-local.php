<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '6HYTUyLHltN04QATgXsQ1CSIwB8oaBa8',
        ],
        'session' => [
            'class' => 'yii\web\DbSession',           
             'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/',
            ],
			
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
  //  $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
