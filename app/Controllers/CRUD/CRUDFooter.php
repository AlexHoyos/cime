<?php

use CIME\Controllers\CRUD\ACRUDControllerMethod;

if($httpMethod instanceof ACRUDControllerMethod){
    $httpMethod->execute($params, $restriction);
    $httpCode = $httpMethod->getHttpCode();
    $response = $httpMethod->getResponse();
} else {
    $httpCode = 405;
    $response["error"] = "Metodo invalido!";
}