<?php

namespace CIME\Controllers\CRUD\Funciones;

use CIME\Controllers\CRUD\ACRUDControllerMethod;
use CIME\Models\Funcion;
use CIME\Models\Pelicula;
use CIME\Models\Sala;

class PUTFuncionMethod extends ACRUDControllerMethod {

    protected function prepare($params = []): void
    {
        $this->httpCode = 400;
        if(isset($params["id"], $params["id_sala"],$params["id_pelicula"],$params["id_formato"],$params["id_idioma"],$params["id_subtitulos"], $params["hora"], $params["dia"], $params["precio_adulto"], $params["precio_adol"], $params["precio_nino"]) == false){
            $this->response["error"] = "No se recibieron todos los parametros";
            return;
        }

        if(empty($params["hora"]) || empty($params["dia"])){
            $this->response["error"] = "Algunos parametros obligatorios estan vacios";
            return;
        }

        $idFuncion = intval($params["id"]);
        $idSala = intval($params["id_sala"]);
        $idPelicula = intval($params["id_pelicula"]);
        $idFormato = intval($params["id_formato"]);
        $idIdioma = intval($params["id_idioma"]);
        $idSubtitulos = intval($params["id_subtitulos"]);
        if($idSubtitulos == 0)
            $idSubtitulos = null;
        $precioAdulto = floatval($params["precio_adulto"]);
        $precioAdol = floatval($params["precio_adol"]);
        $precioNino = floatval($params["precio_nino"]);
        
        if($idFuncion <= 0 || $idSala <= 0 || $idPelicula <= 0 || $idFormato <= 0 || $idIdioma <= 0 || $precioAdulto <= 0 || $precioAdol <= 0 || $precioNino > 0){
            $this->response["error"] = "Algunos campos estan vacios";
            return;
        }

        $funcion = Funcion::getById($idFuncion);
        if($funcion == null){
            $this->response["error"] = "La función seleccionada no existe!";
            return;
        }

        $sala = Sala::getById($idSala);
        if($sala == null){
            $this->response["error"] = "La sala elegida no existe!";
            return;
        }

        $pelicula = Pelicula::getById($idPelicula);
        if($pelicula == null){
            $this->response["error"] = "La pelicula elegida no existe!";
            return;
        }

        if(Funcion::isHorarioDisponible($sala->getId(), $params["hora"], $params["dia"], $pelicula->getDuracion(), $idFuncion) == false){
            $this->response["error"] = "El horario elegido se sobrepone a otra función!";
            return;
        }

        $funcion->setFecha($params["dia"]);
        $funcion->setHora($params["hora"]);
        $funcion->setPrecioAdulto($precioAdulto);
        $funcion->setPrecioAdol($precioAdol);
        $funcion->setPrecioNino($precioNino);
        $funcion->setFormato($idFormato);
        $funcion->setIdioma($idIdioma);
        $funcion->setSubtitulos($idSubtitulos);
        $funcion->setSala($idSala);
        
        if($funcion->update()){

            $this->httpCode = 200;
            $this->response["msg"] = "Función actualizada exitosamente!";
            return;

        } else {
            $this->response["error"] = "Error al actualizar la función!";
            return;
        }

    }

}