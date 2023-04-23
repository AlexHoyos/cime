<?php

namespace CIME\Models;

use CIME\Models\DBModels\AsientoDB;

class Asiento extends AsientoDB{

    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getFila() { return $this->fila; }
    public function getColumna() { return $this->columna; }
    public function getSala() { return $this->id_sala; }

    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setFila($fila) { $this->fila = $fila; }
    public function setColumna($columna) { $this->columna = $columna; }

}