<?php
use CIME\Controllers\CRUD\GETModelMethod;
use CIME\Controllers\CRUD\Usuarios\DELETEUsuarioMethod;
use CIME\Controllers\CRUD\Usuarios\PUTUsuarioMethod;
use CIME\Filters\AccountRoleFilter;
use CIME\Models\Usuario;

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
        $httpMethod = new GETModelMethod(Usuario::class);
    } else if($_SERVER['REQUEST_METHOD'] === 'POST' && $restriction){
        $restriction = AccountRoleFilter::isAdminAccount($user->getId()); // Disponible solo para administradores
        $httpMethod = null;
    } else if($_SERVER['REQUEST_METHOD'] === 'PUT' && $restriction){
        $restriction = AccountRoleFilter::isAdminAccount($user->getId()); // Disponible solo para administradores
        $httpMethod = new PUTUsuarioMethod();
    } else if ($_SERVER['REQUEST_METHOD'] === "DELETE" && $restriction){
        $restriction = AccountRoleFilter::isAdminAccount($user->getId()); // Disponible solo para administradores
        $httpMethod = new DELETEUsuarioMethod();
    }

include 'CRUDFooter.php';
include '../ControllerFooter.php';