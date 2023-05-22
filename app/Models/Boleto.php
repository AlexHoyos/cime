<?php

namespace CIME\Models;

use CIME\Models\DBModels\BoletoBD;

class Boleto extends BoletoBD{

    public function getId() { return $this->id; }
    public function getEstado() { return $this->id_estado; }
    public function getNumAdultos() { return $this->num_adultos; }
    public function getNumAdols() { return $this->num_adols; }
    public function getNumNinos() { return $this->num_ninos; }
    public function getUsuario() { return $this->id_usuario; }
    public function getCorreo() { return $this->correo; }
    public function getFuncion() { return $this->id_funcion; }
    public function isEmpleado() { return $this->es_empleado; }
    public function getCreatedAt(){ return $this->created_at; }

    public function getFuncionInstance(){
        return Funcion::getById($this->getFuncion());
    }

    public function setEstado($id_estado) { $this->id_estado = $id_estado; }
    public function setEsEmpleado($es_empleado) { $this->es_empleado = boolval($es_empleado); }

}