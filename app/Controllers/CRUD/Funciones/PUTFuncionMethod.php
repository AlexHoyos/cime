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
        if(isset($params["id"], $params["id_sala"],$params["id_pelicula"],$params["id_formato"],$params["id_idioma"],$params["id_subtitulos"], $params["hora"], $params["dia"], $params["precio_adulto"], $params["precio_adol"], $params["precio_nino"])){

            if(!empty($params["hora"]) && !empty($params["dia"])){

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
                
                if($idFuncion > 0 && $idSala > 0 && $idPelicula > 0 && $idFormato > 0 && $idIdioma > 0 && $precioAdulto > 0 && $precioAdol > 0 && $precioNino > 0){

                    $funcion = Funcion::getById($idFuncion);
                    if($funcion instanceof Funcion){
                        $sala = Sala::getById($idSala);

                        if($sala instanceof Sala){

                            $pelicula = Pelicula::getById($idPelicula);
                            if($pelicula instanceof Pelicula){

                                if(Funcion::isHorarioDisponible($sala->getId(), $params["hora"], $params["dia"], $pelicula->getDuracion(), $idFuncion)){

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

                                    } else {
                                        $this->response["error"] = "Error al actualizar la función!";
                                    }

                                } else {
                                    $this->response["error"] = "El horario elegido se sobrepone a otra función!";
                                }

                            } else {
                                $this->response["error"] = "La pelicula elegida no existe!";
                            }

                        } else {
                            $this->response["error"] = "La sala elegida no existe!";
                        }
                    } else {
                        $this->response["error"] = "La función seleccionada no existe!";
                    }

                } else {
                    $this->response["error"] = "Algunos campos estan vacios";
                }

            } else {
                $this->response["error"] = "Algunos parametros obligatorios estan vacios";
            }

        } else {
            $this->response["error"] = "No se recibieron todos los parametros " . var_dump($params);
        }
    }

}