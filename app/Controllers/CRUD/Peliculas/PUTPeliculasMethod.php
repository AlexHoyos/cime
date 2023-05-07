<?php

namespace CIME\Controllers\CRUD\Peliculas;

use CIME\Controllers\CRUD\ACRUDControllerMethod;
use CIME\Models\Pelicula;

class PUTPeliculasMethod extends ACRUDControllerMethod {

    protected function prepare($params = []): void {
        $this->httpCode = 400;
        if(isset($params["id"], $params["titulo"], $params["sinopsis"], $params["anio"], $params["duracion"], $params["clasificacion"])){

            if(!empty($params["id"]) && !empty($params["titulo"]) && !empty($params["sinopsis"]) && intval($params["anio"]) > 0 && intval($params["clasificacion"]) > 0){

                $idPeli = intval($params["id"]);
                $peli = Pelicula::getById($idPeli);  
                if($peli instanceof Pelicula){

                    $posterName = "";
                    $wallpaperName = "";
                    if(isset($params["poster"]))
                        if(!empty($params["poster"]["name"]))
                            $posterName = "poster_".uniqid(time().str_replace(" ", "", $params["titulo"])).".jpg";

                    if(isset($params["wallpaper"]))
                        if(!empty($params["wallpaper"]["name"]))
                            $wallpaperName = "wallpaper_".uniqid(time().str_replace(" ", "", $params["titulo"])).".jpg";

                    if(!empty($posterName)){
                        if(move_uploaded_file($params["poster"]["tmp_name"], WEB_PATH.'/Storage/peliculas/'.$posterName) == false)
                            $peli->setPortada($posterName);
                    }

                    if(!empty($wallpaperName)){
                        if(move_uploaded_file($params["wallpaper"]["tmp_name"], WEB_PATH.'/Storage/peliculas/'.$wallpaperName))
                            $peli->setWallpaper($wallpaperName);
                    }
                    
                    $peli->setTitulo($params["titulo"]);
                    $peli->setSinopsis($params["sinopsis"]);
                    $peli->setDuracion($params["duracion"]);
                    $peli->setClasificacion($params["clasificacion"]);

                    if($peli->update()){
                        $this->httpCode = 200;
                        $this->response["msg"] = "Pelicula actualizada con exito!";
                    } else {
                        $this->response["error"] = "Error al actualizar la peliucula!";
                    }

                } else {
                    $this->response["error"] = "No existe la pelicula!";
                }          

            } else {
                $this->response["error"] = "No se llenaron todos los datos obligatorios";
            }

        } else {
            $this->response["error"] = "No se recibieron todos los parametros ";
        }

    }

}