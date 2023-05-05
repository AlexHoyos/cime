<?php

namespace CIME\Models;

use CIME\Models\DBModels\SalaDB;

class Sala extends SalaDB {

    public function getId(){ return $this->id; }
    public function getNombre(){ return $this->nombre; }

    public function getAsientos() {}

    public function setNombre($nombre){ $this->nombre = $nombre; }

    public function toArray():array {
        return [
            "id" => $this->getId(),
            "nombre" => $this->getNombre()
        ];
    }

}