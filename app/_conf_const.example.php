<?php

// RENOMBRAR ESTE ARCHIVO COMO _conf_const.php

const PRODUCTION = false;

/*
    WEBSITE CONSTANTS
*/

const WEB_URL = "http://localhost";
const WEB_PATH = __DIR__;
const WEB_TIMEZONE = "America/Monterrey";

/*
    DATABASE CONSTANTS
*/

const DB_ENGINE = "mysql";
const DB_USER = "root";
const DB_PASSW = "";
const DB_DBNAME = "";
const DB_HOST = "";
const DB_PORT = 3306;

/*
    EMAIL SERVER
*/
const EMAIL_SMTP_HOST = "smtp-mail.outlook.com";
const EMAIL_SMTP_PORT = 587;
const EMAIL_USER = "";
const EMAIL_PASSW = "";

/*
    PAYPAL INFO 
*/

const CLIENT_ID = "";
const CLIENT_SECRET = "";
const PAYPAL_CURRENCY = "MXN";
const PAYPAL_PROD = PRODUCTION;
