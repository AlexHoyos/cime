<?php

namespace CIME\Models;

use CIME\Models\DBModels\ClasificacionDB;

class Clasificacion extends ClasificacionDB {

    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getDescripcion() { return $this->descripcion; }
    public function isForNinos() { return boolval($this->ninos); }
    public function isForAdolescentes() { return boolval($this->adolescentes); }
    public function isForAdolAdult() { return boolval($this->adol_adult); }

    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }
    public function setNinos($isForNinos) { $this->ninos = intval(boolval($isForNinos)); }
    public function setAdolescentes($isForAdolescentes) { $this->adolescentes = intval(boolval($isForAdolescentes)); }
    public function setAdolWithAdult($isForAdolAdult) { $this->adol_adult = intval(boolval($isForAdolAdult)); }

    public function toArray(): array{
        return [
            "id" => $this->getId(),
            "nombre" => $this->getNombre(),
            "descripcion" => $this->getDescripcion(),
            "ninos"=> $this->isForNinos(),
            "adolescentes"=> $this->isForAdolescentes(),
            "adol_adult"=> $this->isForAdolAdult()
        ];
    }

}