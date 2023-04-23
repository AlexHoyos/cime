<?php

namespace CIME\Models\DBModels;

use CIME\Database\ADBModel;
use CIME\Database\DBPagination;
use CIME\Models\Sala;

class SalaDB extends ADBModel {

    public function __construct(
        protected $id,
        protected $nombre
    ){}

    protected static function getTablename(): String {
        return "salas";
    }

    public static function transformRow($row): Sala|null {
            if($row != null)
                return new Sala($row->id, $row->nombre);
            
            return null;
    }

    public static function transformRows($rows): Array {
        return ADBModel::_transformRows($rows, Self::class);
    }

    /* CRUD FUNCTIONS */
    public function create():bool {
        return Self::_executeQuery(" INSERT INTO  " . Self::getTablename() . " (nombre) VALUES ('{$this->nombre}')");
    }
    public function delete():bool{
        return Self::_executeQuery(" DELETE FROM  " . Self::getTablename() . " WHERE id = " . intval($this->id));
    }
    public function update():bool{
        return Self::_executeQuery("UPDATE ". Self::getTablename() . " SET nombre = '{$this->nombre}', WHERE id = " . intval($this->id) );
    }

    public static function getAll():DBPagination{
        return Sala::_getRows(Self::class);     
    }
    
    static public function getById($id): Sala|null {
        $id = intval($id);
        return Self::transformRow(
            Self::_fetchQuery("SELECT * FROM ".Self::getTablename()." WHERE id = {$id} ")
        );
    }

    

}