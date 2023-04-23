<?php

namespace CIME\Models;

use CIME\Models\DBModels\EstadoDB;

class Estado extends EstadoDB {

    public function getId(){ return $this->id; }
    public function getNombre(){ return $this->nombre; }

    public function setNombre($nombre){ $this->nombre = $nombre; }

}