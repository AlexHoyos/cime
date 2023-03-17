<?php

namespace CIME\Models\DBModels;

use CIME\Database\ADBModel;
use CIME\Database\DBPagination;
use CIME\Models\Usuario;

class UsuarioDB extends ADBModel {

    public function __construct(
        protected $id,
        protected $nombre,
        protected $apellido,
        protected $correo,
        protected $telefono,
        protected $nacimiento,
        protected $password,
        protected $reg_date,
        protected $rol,
        protected $secure_code
    ){}

    protected static function getTablename(): String {
        return "usuarios";
    }

    public static function transformRow($row): Usuario|null {
            if($row != null)
                return new Usuario($row->id, $row->nombre, $row->apellido, $row->correo, $row->telefono,
                    $row->nacimiento, $row->password, $row->reg_date, $row->rol, $row->secure_code);
            
            return null;
    }

    public static function transformRows($rows): Array {
        return ADBModel::_transformRows($rows, Self::class);
    }

    /* CRUD FUNCTIONS */
    public function create():bool {
        $values = [$this->nombre, $this->apellido, $this->correo, $this->telefono, $this->nacimiento, $this->password, $this->rol];
        return Self::_executeQuery(" INSERT INTO  " . Self::getTablename() . " (nombre, apellido, correo, telefono, nacimiento, password, rol) VALUES (". implode(", ", $values) . ")");
    }
    public function delete():bool{
        return Self::_executeQuery(" DELETE FROM  " . Self::getTablename() . " WHERE id = " . intval($this->id));
    }
    public function update():bool{
        return Self::_executeQuery("UPDATE ". Self::getTablename() . " SET nombre = {$this->nombre}, apellido = {$this->apellido}, password = {$this->password}, rol = {$this->rol}, secure_code = {$this->secure_code} WHERE id = " . intval($this->id) );
    }

    static public function getAll():DBPagination{
        return Usuario::_getRows(Self::class);     
    }
    
    static public function getById($id): Usuario|null {
        $id = intval($id);
        return Self::transformRow(
            Self::_fetchQuery("SELECT * FROM ".Self::getTablename()." WHERE id = {$id} ", true)
        );
    }

}