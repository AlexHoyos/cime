<?php

namespace CIME\Models\DBModels;

use CIME\Database\ADBModel;
use CIME\Database\DBPagination;
use CIME\Models\Clasificacion;

class ClasificacionDB extends ADBModel {

    public function __construct(
        protected $id,
        protected $nombre,
        protected $descripcion,
        protected $ninos,
        protected $adolescentes
    ){}

    protected static function getTablename(): String {
        return "clasificacion";
    }

    public static function transformRow($row): Clasificacion|null {
            if($row != null)
                return new Clasificacion($row->id, $row->nombre, $row->descripcion, $row->ninos, $row->adolescentes);
            
            return null;
    }

    public static function transformRows($rows): Array {
        return ADBModel::_transformRows($rows, Self::class);
    }

    /* CRUD FUNCTIONS */
    public function create():bool {
        $values = ["'{$this->nombre}'", "'{$this->descripcion}'", "'{$this->ninos}'", "'{$this->adolescentes}'"];
        return Self::_executeQuery(" INSERT INTO  " . Self::getTablename() . " (nombre, descripcion, ninos, adolescentes) VALUES (". implode(", ", $values) . ")");
    }
    public function delete():bool{
        return Self::_executeQuery(" DELETE FROM  " . Self::getTablename() . " WHERE id = " . intval($this->id));
    }
    public function update():bool{
        return Self::_executeQuery("UPDATE ". Self::getTablename() . " SET nombre = '{$this->nombre}', descripcion = '{$this->descripcion}', ninos = '{$this->ninos}', adolescentes = '{$this->adolescentes}' WHERE id = " . intval($this->id) );
    }

    public static function getAll($atributes = [], $conditions = "", $orderBy = ""):DBPagination{
        return Clasificacion::_getRows(Self::class, $atributes, $conditions, $orderBy);
    }
    
    static public function getById($id): Clasificacion|null {
        $id = intval($id);
        return Self::transformRow(
            Self::_fetchQuery("SELECT * FROM ".Self::getTablename()." WHERE id = {$id} ", true)
        );
    }

    

}