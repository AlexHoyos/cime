<?php

use Cime\Database\DatabaseConn;

include_once __DIR__.'./_conf_const.php';

include_once WEB_PATH.'./Database/DatabaseConn.php';

$_dbConn = new DatabaseConn(DB_ENGINE, DB_HOST, DB_PORT, DB_DBNAME, DB_USER, DB_PASSW);