<?php

namespace CIME\Models;

use CIME\Models\DBModels\RolDB;

class Rol extends RolDB {

    public function getId(){ return $this->id; }
    public function getNombre(){ return $this->nombre; }

    public function setNombre($nombre){ $this->nombre = $nombre; }

}