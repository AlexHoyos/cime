<?php

use CIME\Controllers\CRUD\DELETEModelMethod;
use CIME\Controllers\CRUD\Peliculas\POSTPeliculasMethod;
use CIME\Filters\AccountRoleFilter;
use CIME\Models\Pelicula;

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
        $httpMethod = NULL;
    } else if($_SERVER['REQUEST_METHOD'] === 'POST' && $restriction){
        $restriction = AccountRoleFilter::isAdminAccount($user->getId()); // Disponible solo para administradores
        $params = $_POST;
        if(isset($_FILES["poster"]))
            $params["poster"] = $_FILES["poster"];
        if(isset($_FILES["wallpaper"]))
            $params["wallpaper"] = $_FILES["wallpaper"];
        $httpMethod = new POSTPeliculasMethod();
    } else if($_SERVER['REQUEST_METHOD'] === 'PUT' && $restriction){
        $restriction = AccountRoleFilter::isAdminAccount($user->getId()); // Disponible solo para administradores
        $httpMethod = NULL;
    } else if ($_SERVER['REQUEST_METHOD'] === "DELETE" && $restriction){
        $restriction = AccountRoleFilter::isAdminAccount($user->getId()); // Disponible solo para administradores
        $httpMethod = new DELETEModelMethod(Pelicula::class);
    }

include 'CRUDFooter.php';
include '../ControllerFooter.php';