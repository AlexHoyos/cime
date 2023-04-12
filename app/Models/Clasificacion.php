<?php

namespace CIME\Models;

use CIME\Models\DBModels\ClasificacionDB;

class Clasificacion extends ClasificacionDB {

    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getDescripcion() { return $this->descripcion; }
    public function isForNinos() { return $this->ninos; }
    public function isForAdolescentes() { return $this->adolescentes; }

    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }
    public function setNinos($isForNinos) { $this->ninos = $isForNinos; }
    public function setAdolescentes($isForAdolescentes) { $this->adolescentes = $isForAdolescentes; }

    public function toArray(): array{
        return [
            "id" => $this->getId(),
            "nombre" => $this->getNombre(),
            "descripcion" => $this->getDescripcion(),
            "ninos"=> $this->isForNinos(),
            "adolescentes"=> $this->isForAdolescentes()
        ];
    }

}