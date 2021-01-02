<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

require 'class/kkblog.php';

spl_autoload_register(function($class)
{
	require_once 'class/' . $class . '.php';
});

$user     = new User(Session::get("user_id"));
$site     = new Site();
$blog     = new Blog();
$topics   = new Topics();


?>