<?php

include_once 'Config.php';
include_once 'session.php';
include_once 'valid.php';
include_once 'Db.php';
include_once 'User.php';

$db = Db::getInstance();
session::startSession();

session::set("name", 'Blog');




?>

