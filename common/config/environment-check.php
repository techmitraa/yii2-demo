<?php
$ENV = 'prod';
$DEBUG = false;
error_reporting(E_ALL ^E_NOTICE ^E_WARNING);
//CHECK IF IT'S LOCALHOST
if($_SERVER['HTTP_HOST'] == 'localhost')
{
	$ENV = 'dev';
	$DEBUG = true;
}	