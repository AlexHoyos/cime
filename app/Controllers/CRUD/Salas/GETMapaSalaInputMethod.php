<?php

namespace CIME\Controllers\CRUD\Salas;

use CIME\Controllers\CRUD\ACRUDControllerMethod;
use CIME\Models\MapaSala;

class GETMapaSalaInputMethod extends ACRUDControllerMethod{

    protected function prepare($params = []):void {
        
        if(isset($params["filas"]) && isset($params["columnas"])){
            $filas = intval($params["filas"]);
            $columnas = intval($params["columnas"]);
            
            $inputMap = MapaSala::getHtmlMapInput($filas, $columnas);
            
            $this->httpCode = 200;
            $this->response["html"] = $inputMap;
           
        } else {
            $this->httpCode = 400;
            $this->response["error"] = "No se enviaron todos los parametros esperados!";
        }
    }

}