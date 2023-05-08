<?php

namespace CIME\Controllers\CRUD\Clasificaciones;

use CIME\Controllers\CRUD\ACRUDControllerMethod;
use CIME\Models\Clasificacion;

class PUTClasificacionesMethod extends ACRUDControllerMethod {

    protected function prepare($params = []): void
    {
        $this->httpCode = 400;
        if(isset($params["id"]) == false){
            $this->response["error"] = "No se seleccionó una clasificación";
            return;
        }

        $clasificacion = Clasificacion::getById(intval($params["id"]));
        if($clasificacion instanceof Clasificacion){

            if(isset($params["nombre"], $params["descripcion"], $params["ninos"], $params["adols"]) == false){
                $this->response["error"] = "No se recibieron todos los parametros";
                return;
            }

            if(empty($params["nombre"]) || empty($params["ninos"]) || empty($params["adols"])){
                $this->response["error"] = "Algunos parametros obligatorios estan vacios";
                return;
            }

            $clasificacion->setNombre($params["nombre"]);
            $clasificacion->setDescripcion($params["descripcion"]);
            $clasificacion->setNinos($params["ninos"] == 's');
            $clasificacion->setAdolescentes($params["adols"] == 's');
            $clasificacion->setAdolWithAdult($params["adols"] == 'adult');

            if($clasificacion->update()){
                $this->httpCode = 200;
                $this->response["msg"] = "Clasificación actualizada!";
            } else {
                $this->response["error"] = "Error al actualizar la clasificación";
            }

        } else {
            $this->response["error"] = "No se encontró la clasificación seleccionada";
            return;
        }

    }

}