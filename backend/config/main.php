<?php
//use \yii\web\Request;
//$baseUrl = str_replace('/backend/web', '/backend', (new Request)->getBaseUrl());
//die($baseUrl);

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
//        'request' => [
//            'baseUrl' => $baseUrl,
//        ],
        'urlManager' => [
         //   'baseUrl' => $baseUrl,
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
				'/site/login'=>'/user-management/auth/login',
                'projects/project-details/<projectpagename>'=>'projects/project-details',
				'projects/project-details/photos/<projectpagename>'=>'projects/project-images',
				'projects/project-details/videos/<projectpagename>'=>'projects/project-videos',
           
            ],
        ], 
        /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],*/
         'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,   // do not publish the bundle
                    'js' => [
                        //'//code.jquery.com/jquery-1.10.2.min.js',  // use custom jquery
                    ]
                ],
            ],
        ], 
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],        
    ],
    'params' => $params,
];
