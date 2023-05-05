<?php

namespace CIME\Controllers\CRUD\Peliculas;

use CIME\Controllers\CRUD\ACRUDControllerMethod;
use CIME\Models\Pelicula;

class POSTPeliculasMethod extends ACRUDControllerMethod {

    protected function prepare($params = []): void {

        $this->httpCode = 400;
        if(isset($params["titulo"], $params["sinopsis"], $params["anio"], $params["duracion"], $params["clasificacion"], $params["poster"])){

            if(!empty($params["titulo"]) && !empty($params["sinopsis"]) && intval($params["anio"]) > 0 && intval($params["clasificacion"]) > 0 && !empty($params["poster"]["name"])){

                // Subimos el poster
                $posterName = "poster_".uniqid(time().str_replace(" ", "", $params["titulo"])).".jpg";
                $wallpaperName = "";
                if(move_uploaded_file($params["poster"]["tmp_name"], WEB_PATH.'/Storage/peliculas/'.$posterName)){

                    if(isset($params["wallpaper"])){
                        $wallpaperName = "wallpaper_".uniqid(time().str_replace(" ", "",$params["titulo"])).".jpg";
                        if(move_uploaded_file($params["wallpaper"]["tmp_name"], WEB_PATH.'/Storage/peliculas/'.$wallpaperName) == false){
                            $wallpaperName = "";
                        }
                    }

                    $pelicula = new Pelicula(NULL, $params["titulo"], intval($params["anio"]), $params["sinopsis"], $posterName, $wallpaperName, intval($params["duracion"]), intval($params["clasificacion"]));
                    if($pelicula->create()){

                        $this->httpCode = 200;
                        $this->response["msg"] = "Pelicula subida correctamente!";

                    } else {
                        $this->httpCode = 500;
                        $this->response["error"] = "Error al crear la pelicula!";
                    }

                } else {
                    $this->response["error"] = "No se pudo subir el poster";
                }

            } else {
                $this->response["error"] = "No se llenaron todos los datos obligatorios";
            }

        } else {
            $this->response["error"] = "No se recibieron todos los parametros";
        }

    }

}