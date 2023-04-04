<?php

session_start();

use CIME\Database\ADBModel;
use CIME\Database\DatabaseConn;
use PHPMailer\PHPMailer\PHPMailer;

include_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/app/_conf_const.php';

spl_autoload_register(function ($class_name) {
    if(str_contains($class_name, "Enums"))
        $class_name .= '.enum';
    $route = str_replace("CIME", "", $class_name . '.php');
    include_once WEB_PATH . '/'.$route;
});

$_dbConn = new DatabaseConn(DB_ENGINE, DB_HOST, DB_PORT, DB_DBNAME, DB_USER, DB_PASSW);

ADBModel::$dbConn = $_dbConn->getConnection();
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Mailer = "smtp"; 
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = EMAIL_SMTP_PORT;
$mail->Host       = EMAIL_SMTP_HOST;
$mail->Username   = EMAIL_USER;
$mail->Password   = EMAIL_PASSW;
$mail->SetFrom(EMAIL_USER, "CIME NOREPLY");