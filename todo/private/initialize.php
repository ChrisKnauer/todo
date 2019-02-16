<?php   // initialize loads code from functions.php and other libraries, so we only need to include initialize in other pages

// output buffering
ob_start();

// turn on sessions
session_start();

// define constants for file-paths. saves us time typing file-paths. 
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("SHARED_PATH", PRIVATE_PATH . '/shared');
define("PUBLIC_PATH", PROJECT_PATH . '/public');

// define constant for root-directory(public). used for all shared hrefs(e.g. links, css-link).
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

require_once('functions.php');
require_once('database.php');
require_once('query_functions.php');
require_once('validation_functions.php');
require_once('auth_functions.php');

$db = db_connect();

$errors = [];