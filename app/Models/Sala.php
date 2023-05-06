<?php

namespace CIME\Models;

use CIME\Database\ADBModel;
use CIME\Models\DBModels\SalaDB;

class Sala extends SalaDB {

    public function getId(){ return $this->id; }
    public function getNombre(){ return $this->nombre; }

    public function getAsientos() {
        $asientos = Asiento::getAll([], "id_sala = {$this->id}", "ORDER BY fila,columna ASC")->showAll();
        
        return $asientos;
    }

    private function getMapaSalaSize():array{
        $size = ADBModel::_fetchQuery("SELECT MAX(fila) as filas, MAX(columna) as columnas FROM asientos WHERE id_sala = {$this->id}", true);
        return (array) $size;
    }

    public function getMapaSala():MapaSala {
        $size = $this->getMapaSalaSize();
        $mapa = new MapaSala($this->getAsientos(), $size["filas"], $size["columnas"]);
        return $mapa;
    }

    public function setNombre($nombre){ $this->nombre = $nombre; }

    public function toArray():array {
        $size = $this->getMapaSalaSize();
        return [
            "id" => $this->getId(),
            "nombre" => $this->getNombre(),
            "mapaSala" => [
                "filas" => $size["filas"],
                "columnas" => $size["columnas"],
                "asientos" =>  $this->getAsientos()
            ]
        ];
    }

}