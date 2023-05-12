<?php

namespace CIME\Models;

use CIME\Models\DBModels\AsientoReservadoDB;

class AsientoReservado extends AsientoReservadoDB {

    public function getIdAsiento() { return $this->id_asiento; }
    public function getIdFuncion() { return $this->id_funcion; }
    public function getIdBoleto() { return $this->id_boleto; }
    
}