<?php

namespace CIME\Controllers\CRUD;

use CIME\Controllers\CRUD\ACRUDControllerMethod;

class GETModalMethod extends ACRUDControllerMethod{

    public function __construct(
        private $modelClass
    ){}

    protected function prepare($params = []):void {
        
        if(isset($params["id"])){
            
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

}