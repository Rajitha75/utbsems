<?php
date_default_timezone_set('Asia/Kolkata');
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=utbsems',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'enableSchemaCache' => true,
            
            
            // Duration of schema cache.
            'schemaCacheDuration' => 3600,

            // Name of the cache component used to store schema information
            'schemaCache' => 'cache',
        ],
        'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        'useFileTransport' => false,
        'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.gmail.com',  
            'username' => 'utbsemsuniversity@gmail.com',
            'password' => 'UTBsems@2019',
            'port' => '465', 
            'encryption' => 'ssl', 
			'streamOptions' => [ 
			  'ssl' => [ 
				'allow_self_signed' => true,
				'verify_peer' => false,
				'verify_peer_name' => false,
			  ]
			]
        ],
		
    ],
        'user' => [
            'class' => 'webvimark\modules\UserManagement\components\UserConfig',

            // Comment this if you don't want to record user logins
            /* 'on afterLogin' => function($event) {
                    \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
                }*/
        ],
    ],
    'bootstrap' => ['gii'],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module', //adding gii module
            'allowedIPs' => ['127.0.0.1', '::1','172.16.0.85']  //allowing ip's
        ],
        'user-management' => [
            'class' => 'webvimark\modules\UserManagement\UserManagementModule',

            // 'enableRegistration' => true,

            // Here you can set your handler to change layout for any controller or action
            // Tip: you can use this event in any module
            /* 'on beforeAction'=>function(yii\base\ActionEvent $event) {
                    if ( $event->action->uniqueId == 'user-management/auth/login' )
                    {
                        $event->action->controller->layout = 'loginLayout.php';
                    };
                }, */
        ],
    ],
];
