<?php

namespace CIME\Models;

use BoletoBD;

class Boleto extends BoletoBD{

    public function getId() { return $this->id; }
    public function getEstado() { return $this->estado; }
    public function getAsientos() { return $this->asientos; }
    public function getNumAdultos() { return $this->num_adultos; }
    public function getNumAdols() { return $this->num_adols; }
    public function getNumNinos() { return $this->num_ninos; }
    public function getUsuario() { return $this->id_usuario; }
    public function getCorreo() { return $this->correo; }
    public function getFuncion() { return $this->id_funcion; }
    public function isEmpleado() { return $this->es_empleado; }

    public function setEstado($estado) { $this->estado = $estado; }
    public function setAsientos($asientos) { $this->asientos = $asientos; }
    public function setEsEmpleado($es_empleado) { $this->es_empleado = $es_empleado; }

}