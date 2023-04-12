<?php

namespace CIME\Controllers\CRUD\Clasificaciones;

use CIME\Controllers\CRUD\ACRUDControllerMethod;
use CIME\Models\Clasificacion;

class PUTClasificacionesMethod extends ACRUDControllerMethod {

    protected function prepare($params = []): void
    {
        $this->httpCode = 400;
        if(isset($params["id"])){

            $clasificacion = Clasificacion::getById(intval($params["id"]));
            if($clasificacion instanceof Clasificacion){

                if(isset($params["nombre"]) && isset($params["descripcion"]) && isset($params["ninos"]) && isset($params["adols"])){

                    if(!empty($params["nombre"]) && !empty($params["ninos"]) && !empty($params["adols"])){
                        
                        $clasificacion->setNombre($params["nombre"]);
                        $clasificacion->setDescripcion($params["descripcion"]);
                        $clasificacion->setNinos($params["ninos"]);
                        $clasificacion->setAdolescentes($params["adols"]);

                        if($clasificacion->update()){
                            $this->httpCode = 200;
                            $this->response["msg"] = "Clasificación actualizada!";
                        } else {
                            $this->response["error"] = "Error al actualizar la clasificación";
                        }
        
                    } else {
                        $this->response["error"] = "Algunos parametros obligatorios estan vacios";
                    }
        
                } else {
                    $this->response["error"] = "No se recibieron todos los parametros";
                }

            } else {
                $this->response["error"] = "No se encontró la clasificación seleccionada";
            }

        } else {
            $this->response["error"] = "No se seleccionó una clasificación";
        }
    }

}