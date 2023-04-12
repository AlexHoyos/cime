<?php

namespace CIME\Controllers\CRUD\Clasificaciones;

use CIME\Controllers\CRUD\ACRUDControllerMethod;
use CIME\Models\Clasificacion;

class POSTClasificacionesMethod extends ACRUDControllerMethod {

    protected function prepare($params = []): void
    {
        $this->httpCode = 400;
        if(isset($params["nombre"]) && isset($params["descripcion"]) && isset($params["ninos"]) && isset($params["adols"])){

            if(!empty($params["nombre"]) && !empty($params["ninos"]) && !empty($params["adols"])){
                
                $clasificacion = new Clasificacion(NULL, $params["nombre"], $params["descripcion"], $params["ninos"], $params["adols"]);
                if($clasificacion->create()){

                    $this->httpCode = 200;
                    $this->response["msg"] = "Clasificación creada!";

                } else {
                    $this->response["error"] = "Error al crear la clasificación!";
                }
                

            } else {
                $this->response["error"] = "Algunos parametros obligatorios estan vacios";
            }

        } else {
            $this->response["error"] = "No se recibieron todos los parametros";
        }
    }

}