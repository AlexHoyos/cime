<?php

namespace CIME\Models;

use CIME\Models\DBModels\SalaDB;

class Sala extends SalaDB {

    public function getId(){ return $this->id; }
    public function getMapa(){ return $this->mapa; }

    public function setMapa($mapa){ $this->mapa = $mapa; }

}