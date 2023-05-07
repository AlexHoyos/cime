<?php

namespace CIME\Controllers\CRUD\Clasificaciones;

use CIME\Controllers\CRUD\ACRUDControllerMethod;
use CIME\Models\Clasificacion;

class POSTClasificacionesMethod extends ACRUDControllerMethod {

    protected function prepare($params = []): void
    {
        $this->httpCode = 400;
        if(isset($params["nombre"], $params["descripcion"], $params["ninos"], $params["adols"]) == false ){
            $this->response["error"] = "No se recibieron todos los parametros";
            return;
        }

        if(empty($params["nombre"]) || empty($params["ninos"]) || empty($params["adols"])){
            $this->response["error"] = "Algunos parametros obligatorios estan vacios";
            return;
        }
        
        $adol_adult = false;
        if($params["adols"] == "adult"){
            $adol_adult = true;
            $params["adols"] = 's';
        }
            
        $clasificacion = new Clasificacion(NULL, $params["nombre"], $params["descripcion"], $params["ninos"] == 's', $params["adols"] == 's', $adol_adult);
        if($clasificacion->create()){

            $this->httpCode = 200;
            $this->response["msg"] = "Clasificación creada!";

        } else {
            $this->response["error"] = "Error al crear la clasificación!";
        }

    }

}