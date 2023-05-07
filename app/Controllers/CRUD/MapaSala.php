<?php
use CIME\Controllers\CRUD\DELETEModelMethod;
use CIME\Controllers\CRUD\GETMapaSalaMethod;
use CIME\Controllers\CRUD\GETModelMethod;
use CIME\Filters\AccountRoleFilter;
use CIME\Models\Sala;
use CIME\Utils\MapaSala;

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
        $httpMethod = new GETMapaSalaMethod();
    }

include 'CRUDFooter.php';
include '../ControllerFooter.php';