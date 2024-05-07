<?php
ini_set('display_errors', 'on');
//ob_start("ob_gzhandler");
//error_reporting(E_ALL);

// Start the session
session_start();

// Database connection config
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'db_event_management';

// Project data
$site_title = 'Online Banking - www.TechZoo.org';
$email_id = 'customerservice@hlbonline.pro';

$thisFile = str_replace('\\', '/', __FILE__);
$docRoot = $_SERVER['DOCUMENT_ROOT'];

$webRoot = str_replace(array($docRoot, 'library/config.php'), '', $thisFile);
$srvRoot = str_replace('library/config.php', '', $thisFile);

define('WEB_ROOT', $webRoot);
define('SRV_ROOT', $srvRoot);

// Check if incoming data needs escaping (only for PHP versions < 5.4.0)
if (version_compare(PHP_VERSION, '5.4.0') < 0) {
    // Check if magic quotes are enabled
    if (ini_get('magic_quotes_gpc')) {
        // Strip slashes from incoming data if magic quotes are on
        $_POST = array_map_recursive('stripSlashesDeep', $_POST);
        $_GET = array_map_recursive('stripSlashesDeep', $_GET);
        $_COOKIE = array_map_recursive('stripSlashesDeep', $_COOKIE);
        $_REQUEST = array_map_recursive('stripSlashesDeep', $_REQUEST);
    } else {
        // If magic quotes are not on, escape incoming data
        $_POST = array_map_recursive('addSlashesDeep', $_POST);
        $_GET = array_map_recursive('addSlashesDeep', $_GET);
        $_COOKIE = array_map_recursive('addSlashesDeep', $_COOKIE);
        $_REQUEST = array_map_recursive('addSlashesDeep', $_REQUEST);
    }
}

// Function to recursively add slashes to an array
function addSlashesDeep($value)
{
    return is_array($value) ? array_map('addSlashesDeep', $value) : addslashes($value);
}

// Function to recursively strip slashes from an array
function stripSlashesDeep($value)
{
    return is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
}

require_once 'database.php';
require_once 'common.php';
?>
