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




?>