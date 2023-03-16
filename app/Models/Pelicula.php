<?php

namespace CIME\Models;

use CIME\Models\DBModels\PeliculaDB;

class Pelicula extends PeliculaDB {

    public function getId(){ return $this->id; }
    public function getTitulo(){ return $this->titulo; }
    public function getSinopsis(){ return $this->sinopsis; }
    public function getPortada(){ return $this->portada; }
    public function getWallpaper(){ return $this->wallpaper; }
    public function getDuracion(){ return $this->duracion; }
    public function getClasificacion(){ return $this->id_clasificacion; }

    public function setTitulo($titulo){ $this->titulo = $titulo; }
    public function setSinopsis($sinopsis){ $this->sinopsis = $sinopsis; }
    public function setPortada($portada){ $this->portada = $portada; }
    public function setWallpaper($wallpaper){ $this->wallpaper = $wallpaper; }
    public function setDuracion($duracion){ $this->duracion = $duracion; }
    public function setClasificacion($clasificacion){ $this->id_clasificacion = $clasificacion; }

}