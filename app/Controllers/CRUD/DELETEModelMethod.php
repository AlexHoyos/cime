<?php

namespace CIME\Controllers\CRUD;

use CIME\Controllers\CRUD\ACRUDControllerMethod;

class DELETEModelMethod extends ACRUDControllerMethod {

    public function __construct(
        private $modelClass
    ){}

    protected function prepare($params = []): void
    {
        if(isset($params["id"]) == false){
            $this->httpCode = 400;
            $this->response["error"] = "No se proporcionaron todos los parametros";
            return;
        }

        $modelInstance = $this->modelClass::getById(intval($params["id"]));
        if($modelInstance == null){
            $this->httpCode = 404;
            $this->response["error"] = "No se encontró el modelo con esa ID";
            return;
        }

        if($modelInstance->delete() == false){
            $this->httpCode = 500;
            $this->response["error"] = "Error al intentar eliminar";
            return;
        }

        $this->httpCode = 200;
        $this->response["msg"] = "Instancia eliminada";
        return;

    }

}