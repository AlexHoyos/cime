<?php
use CIME\Controllers\CRUD\DELETEModelMethod;
use CIME\Controllers\CRUD\Funciones\POSTFuncionMethod;
use CIME\Controllers\CRUD\Funciones\PUTFuncionMethod;
use CIME\Controllers\CRUD\GETModelMethod;
use CIME\Filters\AccountRoleFilter;
use CIME\Models\Funcion;

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
        $httpMethod = new GETModelMethod(Funcion::class);
    } else if($_SERVER['REQUEST_METHOD'] === 'POST' && $restriction){
        $restriction = AccountRoleFilter::isAdminAccount($user->getId()); // Disponible solo para administradores
        $httpMethod = new POSTFuncionMethod();
    } else if($_SERVER['REQUEST_METHOD'] === 'PUT' && $restriction){
        $restriction = AccountRoleFilter::isAdminAccount($user->getId()); // Disponible solo para administradores
        $httpMethod = new PUTFuncionMethod();
    } else if ($_SERVER['REQUEST_METHOD'] === "DELETE" && $restriction){
        $restriction = AccountRoleFilter::isAdminAccount($user->getId()); // Disponible solo para administradores
        $httpMethod = new DELETEModelMethod(Funcion::class);
    }

include 'CRUDFooter.php';
include '../ControllerFooter.php';