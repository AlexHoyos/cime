<?php
namespace CIME\Models\DBModels;

use CIME\Database\ADBModel;
use CIME\Database\DBPagination;
use CIME\Models\Idioma;

class IdiomaDB extends ADBModel {

    public function __construct(
        protected $id,
        protected $nombre,
        protected $abreviacion
    ){}

    protected static function getTablename(): String {
        return "idiomas";
    }

    public static function transformRow($row): Idioma|null {
        if($row != null)
            return new Idioma($row->id, $row->nombre, $row->abreviacion);
        
        return null;
    }

    public static function transformRows($rows): Array {
        return ADBModel::_transformRows($rows, Self::class);
    }

    /* CRUD FUNCTIONS */
    public function create():bool {
        return Self::_executeQuery(" INSERT INTO  " . Self::getTablename() . " (nombre) VALUES ('{$this->nombre}', '{$this->abreviacion}')");
    }
    public function delete():bool{
        return Self::_executeQuery(" DELETE FROM  " . Self::getTablename() . " WHERE id = " . intval($this->id));
    }
    public function update():bool{
        return Self::_executeQuery("UPDATE ". Self::getTablename() . " SET nombre = '{$this->nombre}', abreviacion = '{$this->abreviacion}' WHERE id = " . intval($this->id) );
    }

    public static function getAll():DBPagination{
        return RolDB::_getRows(Self::class);     
    }

    static public function getById($id): Idioma|null {
        $id = intval($id);
        return Self::transformRow(
            Self::_fetchQuery("SELECT * FROM ".Self::getTablename()." WHERE id = {$id} ")
        );
    }
}