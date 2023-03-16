<?php

use CIME\Database\ADBModel;
use Cime\Database\DatabaseConn;
use CIME\Models\DBModels\Usuario;

include_once __DIR__.'./_conf_const.php';

include_once WEB_PATH.'./Database/DatabaseConn.php';
include_once WEB_PATH . './Database/DBPagination.php';

$_dbConn = new DatabaseConn(DB_ENGINE, DB_HOST, DB_PORT, DB_DBNAME, DB_USER, DB_PASSW);

include_once WEB_PATH .'./Database/ADBModel.php';
ADBModel::$dbConn = $_dbConn->getConnection();

include_once WEB_PATH. './Models/DBModels/Usuario.php';
