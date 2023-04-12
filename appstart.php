<?php
// This is a custom autoloader for this template

use App\Config\DotEnvConfig;
use App\Config\WhoopsConfig;

require_once __DIR__ . "/vendor/autoload.php";

$dotenv = new DotEnvConfig();
if ($_ENV["DEBUG_MODE"] ?? true) {
    ini_set('display_errors', true);
    ini_set('display_startup_errors', true);
    new WhoopsConfig($dotenv->getVars());
}
$dotenv->initConfigs();

// Start DB Vars
$_ENV["DB_HOST"] = $_ENV["DEBUG_MODE"] ? $_ENV["DEBUG_DB_HOST"] : $_ENV["PRODUCTION_DB_HOST"];
$_ENV["DB_NAME"] = $_ENV["DEBUG_MODE"] ? $_ENV["DEBUG_DB_NAME"] : $_ENV["PRODUCTION_DB_NAME"];
$_ENV["DB_USER"] = $_ENV["DEBUG_MODE"] ? $_ENV["DEBUG_DB_USER"] : $_ENV["PRODUCTION_DB_USER"];
$_ENV["DB_PASS"] = $_ENV["DEBUG_MODE"] ? $_ENV["DEBUG_DB_PASS"] : $_ENV["PRODUCTION_DB_PASS"];
$_ENV["DB_PORT"] = $_ENV["DEBUG_MODE"] ? $_ENV["DEBUG_DB_PORT"] : $_ENV["PRODUCTION_DB_PORT"];