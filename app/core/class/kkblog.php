<?php

include_once 'Config.php';
include_once 'Session.php';
include_once 'Valid.php';
include_once 'Db.php';
include_once 'User.php';
include_once 'Email.php';
include_once 'Validator.php';
include_once 'Register.php';
include_once 'Login.php';
include_once 'Blog.php';
include_once 'Comment.php';

$db = Db::getInstance();
Session::startSession();

Session::set("name", 'Blog');

$register = new Register();
$login    = new Login();
$validator = new Validator();

?>

