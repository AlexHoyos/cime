<?php

namespace CIME\Models;

use CIME\Models\DBModels\ResenaDB;

class Resena extends ResenaDB {
    
    public function getId(){ return $this->id; }
    public function getCalificacion(){ return $this->calificacion; }
    public function getDetalles(){ return $this->detalles; }
    public function getBoleto(){ return $this->id_boleto; }

}