<?php

use CIME\Database\ADBModel;
use CIME\Database\DatabaseConn;

include_once __DIR__.'./_conf_const.php';

spl_autoload_register(function ($class_name) {
    $route = str_replace("CIME", "", $class_name . '.php');
    include_once WEB_PATH . './'.$route;
});

$_dbConn = new DatabaseConn(DB_ENGINE, DB_HOST, DB_PORT, DB_DBNAME, DB_USER, DB_PASSW);

ADBModel::$dbConn = $_dbConn->getConnection();
