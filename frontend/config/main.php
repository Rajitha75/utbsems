<?php
//use \yii\web\Request;
//$baseUrl = str_replace('/frontend/web', '/frontend', (new Request)->getBaseUrl());
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'urlManager' => [
            // 'baseUrl' => $baseUrl,
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                'login'=>'site/login',
        'student-login'=>'site/student-login',
        'student-details'=>'site/student-details',
                'professor-login'=>'site/professor-login',
                'exam-officers-login'=>'site/exam-officers-login',
				'reset-password'=>'site/request-password-reset',
				'signupotp'=>'site/signupotp',
				'resendotp'=>'site/resendotp',
                'signup'=>'site/signup',
                'student-register'=>'site/student-register',
                'student-update'=>'site/student-update',
                'student-profile'=>'site/student-profile',
                'student-edit-profile'=>'site/student-edit-profile',
                'create-admin-user'=>'admin/create',
                'create-project'=>'projects/create',
				'project-create'=>'projects/project-create',
                'edit-project'=>'projects/update',
                'participate'=>'project-participation/create',
                'project-participation'=>'project-participation/index',
                'project-co-owners'=>'project-co-owners/index',
                'create-co-owner'=>'project-co-owners/create',
				'co-owner-acceptance'=>'project-co-owners/coowner-to-user',
//                'projects/<title:\d+>/<cat:\d+>/<type:\d+>/<status:\d+>/<from:\d+>/<to:\d+>'=>'projects/index',                
                'private-project-requests'=>'projects/approve',
                'inbox'=>'communique/inbox-mails',
                'sent'=>'communique/sent-mails',                
                'profile'=>'site/user-profile',
                'student-dashboard'=>'site/student-dashboard',
                'search-projects' => 'site/dynamic-new',
                'compose-mail'=>'communique/new-message',
                'how-it-works'=>'site/how-it-works',
                'privacy-policy'=>'site/privacy-policy',
                'terms-of-use'=>'site/terms-of-use',
                'contact-us'=>'site/contact-us',
				'faqs'=>'site/faqs',
				'media/gallery'=>'site/gallery',
				'media/videos'=>'site/videos',
				'media/digital-magazine'=>'site/digital-magazine',
				'media/press-release'=>'site/press-release',
//               'edit-project/<id:\d+>' => 'projects/update'
                'resend-email-verification' => 'site/resend-email-verification',
                'validate-signup-user-otp' => 'site/validate-signup-user-otp',
                'update-signup-user' => 'site/update-signup-user',
                'loginwaygst' => 'site/loginwaygst',
                'getapprovedprojects' => 'site/getapprovedprojects',
				'encryptdata' => 'site/encryptdata',
				'validateuser' => 'site/validateuser',
				'validatesignupuser' => 'site/validatesignupuser',
				'social-partners'=>'social-partners/user-types',
				'social-partners-list'=>'social-partners/users-list',
				'social-partner/<pagename>'=>'social-partners/profile',
				'social-partner/<pagename>/photos'=>'social-partners/image-gallery',
				'social-partner/<pagename>/videos'=>'social-partners/video-gallery',
				'social-partner/<pagename>/projects'=>'social-partners/projects-created-supported',
				'social-partner/<pagename>/activities'=>'social-partners/projects-liked-commented',
				'social-partner/<pagename>/followers'=>'social-partners/followers',
				'project/<projectpagename>'=>'projects/project-details',
				'project/<projectpagename>/photos'=>'projects/project-images',
				'project/<projectpagename>/videos'=>'projects/project-videos',
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['rest','api/rest', 'pluralize'=>false],
                ],
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
				'yii\bootstrap\BootstrapPluginAsset' => [
            'js'=>[]
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
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info','error'],
                    'categories' => ['mail'],
                    'logFile' => '@app/runtime/logs/mail.log',
                    'maxFileSize' => 1024 * 2,
                    'maxLogFiles' => 20,
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info','error'],
                    'categories' => ['database'],
                    'logFile' => '@app/runtime/logs/database.log',
                    'maxFileSize' => 1024 * 2,
                    'maxLogFiles' => 20,
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
            'maxSourceLines' => 20,
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
