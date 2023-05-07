<?php

namespace CIME\Models;

use CIME\Database\ADBModel;
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

    public static function getAsientoFromPos($salaid, $fila, $columna):Asiento|null{
        $asientos = Asiento::getAll([], "id_sala = {$salaid} AND fila = {$fila} AND columna = {$columna}");
        $asiento = $asientos->showAll();
        if($asientos->totalRows() > 0)
            $asiento = Asiento::transformRow((object) $asientos->showAll()[0]);
        else
            $asiento = null;

        return $asiento;
    }

}