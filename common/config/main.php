<?php
require(__DIR__ . '/../../common/config/db-configuration.php');
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host='.$dbConfig['host'].';dbname='.$dbConfig['dbName'],
            'username' => $dbConfig['dbUser'],
            'password' => $dbConfig['dbPass'],
            'charset' => 'utf8',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
];
