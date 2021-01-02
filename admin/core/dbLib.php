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


//REGISTRATION CONFIGURATION
$mailConfirm           = $config->Website_Info("mail_confirm_required");
$regConfirm            = $config->Website_Info("register_confirm");
$passReset             = $config->Website_Info("reg_pass_reset");

$loginAttemp           = $config->Website_Info("max_login_attempts");
$loginFinger           = $config->Website_Info("login_fingerprint");
$redirect              = $config->Website_Info("redirect_after_login");
$encryption            = $config->Website_Info("password_encryption");

$bcrypt                = $config->Website_Info("encryption_cost");
$sha512                = $config->Website_Info("sha512_iterations");
$salt                  = $config->Website_Info("password_salt");
$keylife               = $config->Website_Info("reset_key_life");