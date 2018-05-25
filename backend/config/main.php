<?php
use yii\web\Request;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
$baseUrl = str_replace('/backend/web', '', (new Request)->getBaseUrl() . '/admin');
return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [ 
        'rbac' => [
            'class' => 'yii2mod\rbac\Module',
        ],
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['Super admin', 'Admin'],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                  'js'=>[]
                ],
                'yii\web\JqueryAsset' => 
                [
                    'jsOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'js' => ['http://code.jquery.com/jquery-2.2.4.min.js']
                ]
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        //USING CLASS
        'mailer' => [
            'class' => 'djagya\sparkpost\Mailer',
            'useFileTransport'=>false,
            'apiKey' => ''
        ],
        /* USING SMTP
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport'=>false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.sparkpostmail.com',
                'username' => 'SMTP_Injection',
                //'authentication'=> 'AUTH LOGIN',
                'password' => 'b0eca65b838c62d5108251e62c8f744ba74ae615',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],*/
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            //'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'dashboard'=> 'site/index',
                //Authentication
                'login'=> 'site/login',
                'logout'=> 'site/logout',
                //Countries
                'countries'=> 'countries/index',
                'countries/update/<id:\d+>'=> 'countries/update',
                'countries/delete/<id:\d+>'=> 'countries/delete',
                //States
                'states'=> 'states/index',
                'states/update/<id:\d+>'=> 'states/update',
                'states/delete/<id:\d+>'=> 'states/delete',
                //Cities
                'cities'=> 'cities/index',
                'cities/update/<id:\d+>'=> 'cities/update',
                'cities/delete/<id:\d+>'=> 'cities/delete',
                //Users
                'users'=> 'users/index',
                'users/update/<id:\d+>'=> 'users/update',
                'users/delete/<id:\d+>'=> 'users/delete',
                'users/reset-password/<token:\d+>'=> 'users/reset-password',
                //User roles
                'user-roles'=> 'user-roles/index',
                'user-roles/update/<id:\d+>'=> 'user-roles/update',
                'user-roles/delete/<id:\d+>'=> 'user-roles/delete',
                //SMTP
                'smtp-settings'=> 'smtp-settings/index',
                'smtp-settings/update/<id:\d+>'=> 'smtp-settings/update',
                'smtp-settings/delete/<id:\d+>'=> 'smtp-settings/delete',
            ]
        ],
       'request'=>[
            'baseUrl'             => $baseUrl,
        ]
    ],
    'params' => $params,
];
