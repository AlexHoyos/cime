<?php

namespace CIME\Models;

use CIME\Models\DBModels\FormatoDB;

class Formato extends FormatoDB {

    public function getId(){ return $this->id; }
    public function getNombre(){ return $this->nombre; }

    public function setNombre($nombre){ $this->nombre = $nombre; }

}