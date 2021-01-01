<?php
require_once "class/Lib.php";
require_once "class/Settings.php";
//DATABASE CONFIGURATION

require_once "db.php";


$WIC = Lib::getInstance();
$config =  new Settings();

// db settings
$dbhost          = $config->Website_Info("db_host");
$dbusername      = $config->Website_Info("db_username");
$dbpass          = $config->Website_Info("db_pass");
$dbname          = $config->Website_Info("db_name");
$dbport          = $config->Website_Info("db_port");
$dbtype          = $config->Website_Info("db_type");

//site settings
$webName               = $config->Website_Info("name");
$domain                = $config->Website_Info("base_url");
$script                = $config->Website_Info("root_path");
$redirect              = $config->Website_Info("redirect");
$contact_email         = $config->Website_Info("contact_email");

//session variables
$session               = $config->Website_Info("secure_session");
$http                  = $config->Website_Info("http_only");
$regenerate            = $config->Website_Info("regenerate_id");
$cookie                = $config->Website_Info("use_only_cookie");