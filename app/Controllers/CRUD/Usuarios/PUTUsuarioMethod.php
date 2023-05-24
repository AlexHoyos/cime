<?php

namespace CIME\Controllers\CRUD\Usuarios;

use CIME\Controllers\CRUD\ACRUDControllerMethod;
use CIME\Filters\SessionFilter;
use CIME\Models\Rol;
use CIME\Models\Usuario;

class PUTUsuarioMethod extends ACRUDControllerMethod {

    protected function prepare($params = []): void
    {

        $admin = SessionFilter::getUserBySession();

        $this->httpCode = 400;
        if(isset($params["id"], $params["rol_id"]) == false){
            $this->response["error"] = "No se recibieron todos los parametros necesarios";
            return;
        }

        $usuario = Usuario::getById(intval($params["id"]));
        if($usuario instanceof Usuario){

            if($admin->getId() == $usuario->getId()){
                $this->response["error"] = "No puedes cambiar tu propio rol";
                return;
            }

            $rol = Rol::getById(intval($params["rol_id"]));
            if($rol instanceof Rol){

                $usuario->setRol($rol->getId());
                if($usuario->update() == false){
                    $this->response["error"] = "No se pudo actualizar el rol por un error interno";
                    return;
                }

                $this->httpCode = 200;
                $this->response["msg"] = "Rol actualizado";

            } else {
                $this->response["error"] = "No se encontró el rol seleccionado";
                return;
            }

        } else {
            $this->response["error"] = "No se encontró el usuario seleccionado";
            return;
        }

    }

}