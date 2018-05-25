<?php
//SWITCH DB CONFIGURATION BASED ON ENV
$dbConfig=[];
if(YII_ENV == 'dev')
{
	$dbConfig['host'] = 'localhost';
	$dbConfig['dbName'] = 'yii2-demo';
	$dbConfig['dbUser'] = 'root';
	$dbConfig['dbPass'] = '';
}
else if(YII_ENV == 'prod')
{
	$dbConfig['host'] = 'private-server-db.chjeapzpefli.us-east-1.rds.amazonaws.com';
	$dbConfig['dbName'] = 'yii2-demo';
	$dbConfig['dbUser'] = 'private_username';
	$dbConfig['dbPass'] = 'NGfW2c9SJAneRsbS';
}

