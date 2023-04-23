<?php

use CIME\Database\ADBModel;
use CIME\Database\DBPagination;
use CIME\Models\Boleto;

class BoletoBD extends ADBModel {
    
    public function __construct(
        protected $id,
        protected $id_estado,
        protected $num_adultos,
        protected $num_adols,
        protected $num_ninos,
        protected $id_usuario,
        protected $correo,
        protected $id_funcion,
        protected $es_empleado
    ){}

    protected static function getTablename(): String {
        return "boletos";
    }

    public static function transformRow($row): Boleto|null {
            if($row != null)
                return new Boleto($row->id, $row->id_estado, $row->num_adultos, $row->num_adols, $row->num_ninos, $row->id_usuario, $row->correo, $row->id_funcion, $row->es_empleado);
            
            return null;
    }

    public static function transformRows($rows): Array {
        return ADBModel::_transformRows($rows, Self::class);
    }

    /* CRUD FUNCTIONS */
    public function create():bool {
        $values = [$this->id_estado,  $this->num_adultos, $this->num_adols, $this->num_ninos, $this->id_usuario, "'{$this->correo}'", $this->id_funcion, boolval($this->es_empleado)];
        return Self::_executeQuery(" INSERT INTO  " . Self::getTablename() . " (id_estado, num_adultos, num_adols, num_ninos, id_usuario, correo, id_funcion, es_empleado) VALUES (". implode(", ", $values) . ")");
    }
    public function delete():bool{
        return Self::_executeQuery(" DELETE FROM  " . Self::getTablename() . " WHERE id = " . intval($this->id));
    }
    public function update():bool{
        return Self::_executeQuery("UPDATE ". Self::getTablename() . " SET id_estado = {$this->id_estado}, es_empleado = {$this->es_empleado} WHERE id = " . intval($this->id) );
    }

    public static function getAll():DBPagination{
        return Boleto::_getRows(Self::class);     
    }
    
    static public function getById($id): Boleto|null {
        $id = intval($id);
        return Self::transformRow(
            Self::_fetchQuery("SELECT * FROM ".Self::getTablename()." WHERE id = {$id} ")
        );
    }

    

}