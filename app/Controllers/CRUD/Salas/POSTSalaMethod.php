<?php

namespace CIME\Controllers\CRUD\Salas;

use CIME\Controllers\CRUD\ACRUDControllerMethod;
use CIME\Models\Asiento;
use CIME\Models\Sala;

class POSTSalaMethod extends ACRUDControllerMethod {

    protected function prepare($params = []): void
    {
        $this->httpCode = 400;
        if(isset($params["nombre"], $params["asientos"]) == false){
            $this->response["error"] = "No se recibieron todos los parametros";
            return;
        }

        if(empty($params["nombre"])){
            $this->response["error"] = "Algunos parametros obligatorios estan vacios";
            return;
        }
        // Creamos la SALA
        $sala = new Sala(NULL, $params["nombre"]);
        if($sala->create() == false){
            $this->response["error"] = "Error al crear la sala!";
            return;
        }

        $NuevaSala = Sala::getAll(["id"], "nombre = '".$params["nombre"]."'", "ORDER BY id DESC")->showAll();
        if(isset($NuevaSala[0]) == false){
            $this->response["error"] = "Se ha creado la sala pero no se ha podido registrar los asientos!";
            return;
        }

        $salaId = $NuevaSala[0]["id"];
        // Registramos los asientos
        $asientos = $params["asientos"];
        foreach($asientos as $asiento){
            $asiento = json_decode($asiento);
            $nuevoAsiento = new Asiento(NULL, $asiento->nombre, $asiento->fila, $asiento->columna, $salaId);
            $nuevoAsiento->create();
        }

        if($nuevoAsiento instanceof Asiento){
            $this->httpCode = 200;
            $this->response["msg"] = "Sala creada!";
            return;
        } else {
            $this->response["error"] = "Se ha creado la sala pero no se han registrado correctamente los asientos";
            return;
        }
            
    }

}