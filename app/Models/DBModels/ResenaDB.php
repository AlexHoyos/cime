<?php

namespace CIME\Models\DBModels;

use CIME\Database\ADBModel;
use CIME\Database\DBPagination;
use CIME\Models\Resena;

class ResenaDB extends ADBModel {

    public function __construct(
        protected $id,
        protected $calificacion,
        protected $detalles,
        protected $id_boleto
    ){}

    public static function getTablename(): String {
        return "resena";
    }

    public static function transformRow($row): Resena|null {
            if($row != null)
                return new Resena($row->id, $row->calificacion, $row->detalles, $row->id_boleto);
            
            return null;
    }

    public static function transformRows($rows): Array {
        return ADBModel::_transformRows($rows, Self::class);
    }

    /* CRUD FUNCTIONS */
    public function create():bool {
        $values = [$this->calificacion, "'{$this->detalles}'", $this->id_boleto];
        return Self::_executeQuery(" INSERT INTO  " . Self::getTablename() . " (calificacion, detalles, id_boleto) VALUES (". implode(", ", $values) . ")");
    }
    public function delete():bool{
        return Self::_executeQuery(" DELETE FROM  " . Self::getTablename() . " WHERE id = " . intval($this->id));
    }
    public function update():bool{
        return false;
    }

    public static function getAll():DBPagination{
        return Resena::_getRows(Self::class);     
    }
    
    static public function getById($id): Resena|null {
        $id = intval($id);
        return Self::transformRow(
            Self::_fetchQuery("SELECT * FROM ".Self::getTablename()." WHERE id = {$id} ")
        );
    }

    

}