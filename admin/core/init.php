<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

spl_autoload_register(function($class)
{
	require_once 'class/' . $class . '.php';
});

$site = new site();


?>