<?php

namespace CIME\Controllers\CRUD\Usuarios;

use CIME\Controllers\CRUD\ACRUDControllerMethod;
use CIME\Filters\SessionFilter;
use CIME\Models\Usuario;

class DELETEUsuarioMethod extends ACRUDControllerMethod {


    protected function prepare($params = []): void
    {
        if(isset($params["id"]) == false){
            $this->httpCode = 400;
            $this->response["error"] = "No se proporcionaron todos los parametros";
            return;
        }

        $usuario = Usuario::getById(intval($params["id"]));
        if($usuario == null){
            $this->httpCode = 404;
            $this->response["error"] = "No se encontró el usuario con esa ID";
            return;
        }

        $admin = SessionFilter::getUserBySession();
        if($admin->getId() == $usuario->getId()){
            $this->response = 400;
            $this->response["error"] = "No te puedes eliminar a ti mismo!";
            return;
        }

        if($usuario->delete() == false){
            $this->httpCode = 500;
            $this->response["error"] = "Error al intentar eliminar";
            return;
        }

        $this->httpCode = 200;
        $this->response["msg"] = "Usuario eliminado";
        return;

    }

}