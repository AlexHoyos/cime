<?php

namespace CIME\Models;

use CIME\Models\DBModels\PeliculaDB;

class Pelicula extends PeliculaDB {

    public function getId(){ return $this->id; }
    public function getTitulo(){ return $this->titulo; }
    public function getAnio() { return $this->anio; }
    public function getSinopsis(){ return $this->sinopsis; }
    public function getPortada(){ return $this->portada; }
    public function getWallpaper(){ return $this->wallpaper; }
    public function getDuracion(){ return $this->duracion; }
    public function getClasificacion(){ return $this->id_clasificacion; }

    public function getClasificacionInstance(): Clasificacion|null{
        return Clasificacion::getById($this->id_clasificacion);
    }

    public function setTitulo($titulo){ $this->titulo = $titulo; }
    public function setAnio($anio) { $this->anio = intval($anio) ; }
    public function setSinopsis($sinopsis){ $this->sinopsis = $sinopsis; }
    public function setPortada($portada){ $this->portada = $portada; }
    public function setWallpaper($wallpaper){ $this->wallpaper = $wallpaper; }
    public function setDuracion($duracion){ $this->duracion = intval($duracion); }
    public function setClasificacion($clasificacion){ $this->id_clasificacion = intval($clasificacion); }

    public static function getPeliculasCarousel(){
        $tablename = Self::getTablename();
        $funcionesTablename = Funcion::getTablename();
        return Pelicula::_fetchQuery("SELECT {$tablename}.* FROM {$funcionesTablename},{$tablename} WHERE {$funcionesTablename}.id_pelicula = {$tablename}.id AND fecha >= CURRENT_DATE AND {$tablename}.wallpaper != '' GROUP BY {$funcionesTablename}.id_pelicula");
    }

    public static function getPeliculasInCartelera($fecha = "", $onlyThisPeliId = 0){
        $tablename = Self::getTablename();
        $funcionesTablename = Funcion::getTablename();

        $peliRestriction = "";
        if($onlyThisPeliId > 0)
            $peliRestriction = "AND {$funcionesTablename}.id_pelicula = {$onlyThisPeliId} ";

        if($fecha == "")
            $fecha = ">= CURRENT_DATE";
        else
            $fecha = "= '{$fecha}'";

        return Pelicula::_fetchQuery("SELECT {$tablename}.* FROM {$funcionesTablename},{$tablename} WHERE {$funcionesTablename}.id_pelicula = {$tablename}.id AND fecha {$fecha} {$peliRestriction} GROUP BY {$funcionesTablename}.id_pelicula");
    }

    public function toArray(): array{
        return [
            "id" => $this->getId(),
            "titulo" => $this->getTitulo(),
            "anio" => $this->getAnio(),
            "sinopsis" => $this->getSinopsis(),
            "portada"=> $this->getPortada(),
            "wallpaper"=> $this->getWallpaper(),
            "duracion"=> $this->getDuracion(),
            "id_clasificacion" => $this->getClasificacion()
        ];
    }

}