<?php

namespace CIME\Models\DBModels;

use CIME\Database\ADBModel;
use CIME\Database\DBPagination;
use CIME\Models\Asiento;

class AsientoDB extends ADBModel {

    public function __construct(
        protected $id,
        protected $nombre,
        protected $fila,
        protected $columna,
        protected $id_sala
    ){}

    public static function getTablename(): String {
        return "asientos";
    }

    public static function transformRow($row): Asiento|null {
        if($row != null)
            return new Asiento($row->id, $row->nombre, $row->fila, $row->columna, $row->id_sala);
        
        return null;
    }

    public static function transformRows($rows): Array {
        return ADBModel::_transformRows($rows, Self::class);
    }

    /* CRUD FUNCTIONS */
    public function create():bool {
        return Self::_executeQuery(" INSERT INTO  " . Self::getTablename() . " (nombre, fila, columna, id_sala) VALUES ('{$this->nombre}', {$this->fila}, {$this->columna}, {$this->id_sala}");
    }
    public function delete():bool{
        return Self::_executeQuery(" DELETE FROM  " . Self::getTablename() . " WHERE id = " . intval($this->id));
    }
    public function update():bool{
        return Self::_executeQuery("UPDATE ". Self::getTablename() . " SET nombre = '{$this->nombre}', fila = {$this->fila}, columna = {$this->columna} WHERE id = " . intval($this->id) );
    }

    public static function getAll():DBPagination{
        return RolDB::_getRows(Self::class);     
    }

    static public function getById($id): Asiento|null {
        $id = intval($id);
        return Self::transformRow(
            Self::_fetchQuery("SELECT * FROM ".Self::getTablename()." WHERE id = {$id} ")
        );
    }

}