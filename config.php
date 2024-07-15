<?php

//comment this out to enable php default logging
// error_reporting(~E_ALL);

//To allow for multiple environments configuration
$env = 'DEV';

//Logging related constants
define('LOG_LOCATION', 'php://stderr');
// define('LOG_LOCATION', '/var/log/php/error.log');
define('TIMEZONE', 'Asia/Karachi');

//Default message in case route not found or nothing received from route
define('DEFAULT_MESSAGE',"Unable to load resource");
//Default status in case route not found or nothing received from route
define('DEFAULT_STATUS',"Failed");


if ($env == 'DEV') {
    //database configuration
    define('DBTYPE', 'mysql');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBNAME', 'ecommerce');
}

?>