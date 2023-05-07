<?php

namespace CIME\Controllers\CRUD\Salas;

use CIME\Controllers\CRUD\ACRUDControllerMethod;
use CIME\Models\Asiento;
use CIME\Models\Sala;

class PUTSalaMethod extends ACRUDControllerMethod {

    protected function prepare($params = []): void
    {
        $this->httpCode = 400;
        if(isset($params["id"], $params["nombre"]) && isset($params["asientos"]) == false){
            $this->response["error"] = "No se recibieron todos los parametros ";
            return;
        }
        $sala = Sala::getById($params["id"]);

        if($sala == null){
            $this->response["error"] = "No se encontro una sala con ese ID";
            return;
        }

        if(!empty($params["nombre"]))
            $sala->setNombre($params["nombre"]);

        $asientos = $params["asientos"];
        foreach($asientos as $asiento){
            $asiento = json_decode($asiento);
            $asientoExistente = Asiento::getAsientoFromPos($sala->getId(), $asiento->fila, $asiento->columna);
            if($asientoExistente instanceof Asiento){
                $asientoExistente->setNombre($asiento->nombre);
                $asientoExistente->update();
            } else {
                $nuevoAsiento = new Asiento(NULL, $asiento->nombre, $asiento->fila, $asiento->columna, $sala->getId());
                $nuevoAsiento->create();
            }  
        }

        if($sala->update()){
            $this->httpCode = 200;
            $this->response["msg"] = "Sala actualizada!";
            return;
        } else {
            $this->response["error"] = "No se pudo actualizar la sala!";
            return;
        }

    }

}