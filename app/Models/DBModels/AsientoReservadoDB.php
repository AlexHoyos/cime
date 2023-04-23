<?php

namespace CIME\Models\DBModels;

use CIME\Database\ADBModel;
use CIME\Database\DBPagination;
use CIME\Models\AsientoReservado;

class AsientoReservadoDB extends ADBModel {

    public function __construct(
        protected $id,
        protected $id_asiento,
        protected $is_nino,
        protected $is_adol,
        protected $is_adulto,
        protected $id_boleto
    ){}

    protected static function getTablename(): String {
        return "asientos_reservados";
    }

    public static function transformRow($row): AsientoReservado|null {
        if($row != null)
            return new AsientoReservado($row->id, $row->id_asiento, $row->is_nino, $row->is_adol, $row->is_adulto, $row->id_boleto);
        
        return null;
    }

    public static function transformRows($rows): Array {
        return ADBModel::_transformRows($rows, Self::class);
    }

    /* CRUD FUNCTIONS */
    public function create():bool {
        return Self::_executeQuery(" INSERT INTO  " . Self::getTablename() . " (id_asiento, is_nino, is_adol, is_adulto, id_boleto) VALUES ({$this->id_asiento}, {$this->is_nino}, {$this->is_adol}, {$this->is_adulto}, {$this->id_boleto})");
    }
    public function delete():bool{
        return Self::_executeQuery(" DELETE FROM  " . Self::getTablename() . " WHERE id = " . intval($this->id));
    }
    public function update():bool{
        return false;
    }

    public static function getAll():DBPagination{
        return RolDB::_getRows(Self::class);
    }

    static public function getById($id): AsientoReservado|null {
        $id = intval($id);
        return Self::transformRow(
            Self::_fetchQuery("SELECT * FROM ".Self::getTablename()." WHERE id = {$id} ")
        );
    }
}