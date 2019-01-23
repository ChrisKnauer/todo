<?php   // initialize loads code from functions.php and other libraries, so we only need to include initialize in other pages

// set constants for file-paths
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("SHARED_PATH", PRIVATE_PATH . '/shared/');
define("PUBLIC_PATH", PROJECT_PATH . '/public/');


require_once('functions.php');