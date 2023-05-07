<?php

namespace CIME\Controllers\CRUD;

use CIME\Controllers\CRUD\ACRUDControllerMethod;

class GETModelMethod extends ACRUDControllerMethod{

    public function __construct(
        private $modelClass
    ){}

    protected function prepare($params = []):void {
        
        if(!isset($params["id"])){
            $this->httpCode = 400;
            $this->response["error"] = "No se enviaron todos los parametros esperados!";
            return;
        }

        $modelInstance = $this->modelClass::getById(intval($params["id"]));
        if($modelInstance instanceof $this->modelClass){
            
            $this->httpCode = 200;
            $this->response = $modelInstance->toArray();

        } else {
            
            $this->httpCode = 404;
            $this->response["error"] = "No se encontró dicho registro";
        }

    }

}