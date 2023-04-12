<?php
use CIME\Controllers\CRUD\Clasificaciones\GETClasificacionesMethod;
use CIME\Filters\AccountRoleFilter;

include '../ControllerHeader.php';
include 'CRUDHeader.php';

/**
 * CRUD HEADER CONTIENE:
 * $user - Contiene la instancia de Usuario o NULO si no existe
 * $httpMethod - ACRUDControllerMethod Class
 * $params - Contiene un arreglo de los parametros recibidos en cabecera HTTP excepto del metodo GET
 * $restriction - La restrucción de ejecución, por defecto es si el usuario existe.
 */

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $restriction = true; // Disponible para todos
    $params = $_GET; // Guardamos parametros del GET
    $httpMethod = new GETClasificacionesMethod();
} else if($_SERVER['REQUEST_METHOD'] === 'POST' && $restriction){
    $restriction = AccountRoleFilter::isAdminAccount($user->getId()); // Disponible solo para administradores
    $httpMethod = null;
} else if($_SERVER['REQUEST_METHOD'] === 'PUT' && $restriction){
    $response["msg"] = $params["test"];
} else if ($_SERVER['REQUEST_METHOD'] === "DELETE" && $restriction){
    $response["msg"] = $params["test"];
}

include 'CRUDFooter.php';
include '../ControllerFooter.php';