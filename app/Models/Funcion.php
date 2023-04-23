<?php

namespace CIME\Models;

use CIME\Models\DBModels\FuncionDB;

class Funcion extends FuncionDB {
    
    public function getId(){ return $this->id; }
    public function getPrecioAdulto(){ return $this->precio_adulto; }
    public function getPrecioAdol(){ return $this->precio_adol; }
    public function getPrecioNino(){ return $this->precio_nino; }
    public function getFormato(){ return $this->id_formato; }
    public function getIdioma(){ return $this->id_idioma; }
    public function getSubtitulos(){ return $this->id_subtitulos; }
    public function getFecha(){ return $this->fecha; }
    public function getHora(){ return $this->hora; }
    public function getSala(){ return $this->id_sala; }
    public function getPelicula(){ return $this->id_pelicula; }

    public function setId($id){ $this->id = $id; }
    public function setPrecioAdulto($precio){ $this->precio_adulto = $precio; }
    public function setPrecioAdol($precio){ $this->precio_adol = $precio; }
    public function setPrecioNino($precio){ $this->precio_nino = $precio; }
    public function setFormato($id_formato){ $this->id_formato = $id_formato; }
    public function setIdioma($id_idioma){ $this->id_idioma = $id_idioma; }
    public function setSubtitulos($id_idioma){ $this->id_subtitulos = $id_idioma; }
    public function setFecha($fecha){ $this->fecha = $fecha; }
    public function setHora($hora){ $this->hora = $hora; }
    public function setSala($sala){ $this->id_sala = $sala; }
    public function setPelicula($pelicula){ $this->id_pelicula = $pelicula; }

}