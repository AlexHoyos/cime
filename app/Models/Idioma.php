<?php

namespace CIME\Models;

use CIME\Models\DBModels\IdiomaDB;

class Idioma extends IdiomaDB{

    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getAbreviacion() { return $this->abreviacion; }

    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setAbreviacion($abreviacion) { $this->abreviacion = $abreviacion; }

}