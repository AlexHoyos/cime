<?php

namespace CIME\Controllers\CRUD;

use CIME\Controllers\CRUD\ACRUDControllerMethod;

class DELETEModelMethod extends ACRUDControllerMethod {

    public function __construct(
        private $modelClass
    ){}

    protected function prepare($params = []): void
    {
        if(isset($params["id"])){

            $modelInstance = $this->modelClass::getById(intval($params["id"]));
            if($modelInstance != null){

                if($modelInstance->delete()){
                    $this->httpCode = 200;
                    $this->response["msg"] = "Instancia eliminada";
                } else {
                    $this->httpCode = 500;
                    $this->response["error"] = "Error al intentar eliminar";                    
                }

            } else {
                $this->httpCode = 404;
                $this->response["error"] = "No se encontró el modelo con esa ID";
            }

        } else {
            $this->httpCode = 400;
            $this->response["error"] = "No se proporcionaron todos los parametros";
        }
    }

}