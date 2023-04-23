<?php

namespace CIME\Models;

use CIME\Models\DBModels\AsientoReservadoDB;

class AsientoReservado extends AsientoReservadoDB {

    public function getId() { return $this->id; }
    public function getAsiento() { return $this->id_asiento; }
    public function isNino() { return $this->is_nino; }
    public function isAdol() { return $this->is_adol; }
    public function isAdulto() { return $this->is_adulto; }
    public function getBoleto() { return $this->id_boleto; }

}