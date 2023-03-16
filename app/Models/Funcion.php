<?php

namespace CIME\Models;

use CIME\Models\DBModels\FuncionDB;

class Funcion extends FuncionDB {
    
    public function getId(){ return $this->id; }
    public function getMascara(){ return $this->mascara_mapa; }
    public function getPrecioAdulto(){ return $this->precio_adulto; }
    public function getPrecioAdol(){ return $this->precio_adol; }
    public function getPrecioNino(){ return $this->precio_nino; }
    public function getFormato(){ return $this->formato; }
    public function getLenguaje(){ return $this->lenguaje; }
    public function getSubtitulos(){ return $this->subtitulos; }
    public function getFecha(){ return $this->fecha; }
    public function getHora(){ return $this->hora; }
    public function getSala(){ return $this->id_sala; }
    public function getPelicula(){ return $this->id_pelicula; }

    public function setId($id){ $this->id = $id; }
    public function setMascara($mascara){ $this->mascara_mapa = $mascara; }
    public function setPrecioAdulto($precio){ $this->precio_adulto = $precio; }
    public function setPrecioAdol($precio){ $this->precio_adol = $precio; }
    public function setPrecioNino($precio){ $this->precio_nino = $precio; }
    public function setFormato($formato){ $this->formato = $formato; }
    public function setLenguaje($lenguaje){ $this->lenguaje = $lenguaje; }
    public function setSubtitulos($subtitulos){ $this->subtitulos = $subtitulos; }
    public function setFecha($fecha){ $this->fecha = $fecha; }
    public function setHora($hora){ $this->hora = $hora; }
    public function setSala($sala){ $this->id_sala = $sala; }
    public function setPelicula($pelicula){ $this->id_pelicula = $pelicula; }

}