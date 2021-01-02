<?php

include_once dirname(dirname(dirname(dirname(__FILE__)))) . "/admin/core/dbLib.php";

date_default_timezone_set("UTC");

//path variables
define ('ROOT_PATH', $script );

define('BASE_URL', $domain);

define('redirect', $redirect);

define('name', $webName);
//db settings
define("DB_HOST", $dbhost); 

define("DB_TYPE", $dbtype); 

define("DB_USER", $dbusername); 

define("DB_PASS", $dbpass); 

define("DB_NAME", $dbname); 

//site settings
define('CONTACT_EMAIL', $contact_email);

//SESSION CONFIGURATION

define("SESSION_SECURE", $session);   

define("SESSION_HTTP_ONLY", $http);

define("SESSION_REGENERATE_ID", $regenerate);   

define("SESSION_USE_ONLY_COOKIES", $cookie);


//REGISTRATION CONFIGURATION
define("MAIL_CONFIRMATION_REQUIRED", $mailConfirm); 

define("REGISTER_CONFIRM", $regConfirm); 

define("REGISTER_PASSWORD_RESET", $passReset); 
//LOGIN CONFIGURATION

define("LOGIN_MAX_LOGIN_ATTEMPTS", $loginAttemp); 

define("LOGIN_FINGERPRINT", $loginFinger); 

define("SUCCESS_LOGIN_REDIRECT", serialize(array( "default" => $redirect ))); 

//PASSWORD CONFIGURATION

define("PASSWORD_ENCRYPTION", $encryption); 
//available values: "sha512", "bcrypt"

define("PASSWORD_BCRYPT_COST", $bcrypt); 

define("PASSWORD_SHA512_ITERATIONS", $sha512); 

define("PASSWORD_SALT", $salt); //22 characters to be appended on first 7 characters that will be generated using PASSWORD_ info above



?>