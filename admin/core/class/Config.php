<?php

include_once dirname(dirname(dirname(__FILE__))) . "/admin/WICore/WILib.php";

date_default_timezone_set("UTC");

define ('ROOT_PATH', realpath(dirname(__FILE__)));

define('BASE_URL', 'http://localhost/blog/');

define('redirect', $redirect);

//REGISTRATION CONFIGURATION
define("MAIL_CONFIRMATION_REQUIRED", $mailConfirm); 

define("REGISTER_CONFIRM", $regConfirm); 

define("REGISTER_PASSWORD_RESET", $passReset); 

define('LOGIN_MAX_LOGIN_ATTEMPTS', $loginAttemp); 

define('LOGIN_FINGERPRINT', $loginFinger); 

define('SUCCESS_LOGIN_REDIRECT', serialize(array( 'default' => "WIAdmin/dashboard.php" ))); 


//PASSWORD CONFIGURATION

define('PASSWORD_ENCRYPTION', $encryption); //available values: "sha512", "bcrypt"

define('PASSWORD_BCRYPT_COST', $bcrypt); 

define('PASSWORD_SHA512_ITERATIONS', $sha512); 

define('PASSWORD_SALT', $salt); //22 characters to be appended on first 7 characters that will be generated using PASSWORD_ info above

define('PASSWORD_RESET_KEY_LIFE', $keylife); 
?>