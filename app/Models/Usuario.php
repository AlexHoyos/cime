<?php

namespace CIME\Models;

use CIME\Models\DBModels\UsuarioDB;

class Usuario extends UsuarioDB {

    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getApellido() { return $this->apellido; }
    public function getCorreo() { return $this->correo; }
    public function getTelefono() { return $this->telefono; }
    public function getNacimiento() { return $this->nacimiento; }
    public function getPassword() { return $this->password; }
    public function getRegDate() { return $this->reg_date; }
    public function getRol() { return $this->rol; }
    public function getSecureCode() { return $this->secure_code; }

    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setApellido($apellido) { $this->apellido = $apellido; }
    public function setPassword($password) { $this->password = $password; }
    public function setRol($rol) { $this->rol = $rol; }
    public function setSecureCode($secure_code) { $this->secure_code = $secure_code; }

}