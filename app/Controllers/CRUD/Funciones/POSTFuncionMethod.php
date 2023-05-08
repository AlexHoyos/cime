<?php

namespace CIME\Controllers\CRUD\Funciones;

use CIME\Controllers\CRUD\ACRUDControllerMethod;
use CIME\Models\Funcion;
use CIME\Models\Pelicula;
use CIME\Models\Sala;

class POSTFuncionMethod extends ACRUDControllerMethod {

    protected function prepare($params = []): void
    {
        $this->httpCode = 400;
        if(isset($params["id_sala"],$params["id_pelicula"],$params["id_formato"],$params["id_idioma"],$params["id_subtitulos"], $params["hora"], $params["dia"], $params["precio_adulto"], $params["precio_adol"], $params["precio_nino"]) == false){
            $this->response["error"] = "No se recibieron todos los parametros " . var_dump($params);
            return;
        }

        if(empty($params["hora"]) || empty($params["dia"])){
            $this->response["error"] = "Algunos parametros obligatorios estan vacios";
            return;
        }

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
        
        if($idSala <= 0 || $idPelicula <= 0 || $idFormato <= 0 || $idIdioma <= 0 || $precioAdulto <= 0 || $precioAdol <= 0 || $precioNino > 0){
            $this->response["error"] = "Algunos campos estan vacios";
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

        if(Funcion::isHorarioDisponible($sala->getId(), $params["hora"], $params["dia"], $pelicula->getDuracion()) == false){
            $this->response["error"] = "El horario elegido se sobrepone a otra función!";
            return;
        }

        $funcion = new Funcion(NULL, $precioAdulto, $precioAdol, $precioNino, $idFormato, $idIdioma, $idSubtitulos, $params["dia"], $params["hora"], $idSala, $idPelicula);
        if($funcion->create()){

            $this->httpCode = 200;
            $this->response["msg"] = "Función creada exitosamente!";
            return;

        } else {
            $this->response["error"] = "Error al crear la función!";
            return;
        }

    }

}