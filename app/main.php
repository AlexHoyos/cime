<?php

session_start();

use CIME\Database\ADBModel;
use CIME\Database\DatabaseConn;

include_once $_SERVER['DOCUMENT_ROOT'].'/app/_conf_const.php';

spl_autoload_register(function ($class_name) {
    if(str_contains($class_name, "Enums"))
        $class_name .= '.enum';
    $route = str_replace("CIME", "", $class_name . '.php');
    include_once WEB_PATH . '/'.$route;
});

$_dbConn = new DatabaseConn(DB_ENGINE, DB_HOST, DB_PORT, DB_DBNAME, DB_USER, DB_PASSW);

ADBModel::$dbConn = $_dbConn->getConnection();
