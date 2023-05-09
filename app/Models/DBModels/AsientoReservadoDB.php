<?php

namespace CIME\Models\DBModels;

use CIME\Database\ADBModel;
use CIME\Database\DBPagination;
use CIME\Models\AsientoReservado;

class AsientoReservadoDB extends ADBModel {

    public function __construct(
        protected $id_asiento,
        protected $id_funcion,
        protected $id_boleto
    ){}

    public static function getTablename(): String {
        return "asientos_reservados";
    }

    public static function transformRow($row): AsientoReservado|null {
        if($row != null)
            return new AsientoReservado($row->id_asiento, $row->id_funcion, $row->id_boleto);
        
        return null;
    }

    public static function transformRows($rows): Array {
        return ADBModel::_transformRows($rows, Self::class);
    }

    /* CRUD FUNCTIONS */
    public function create():bool {
        return Self::_executeQuery(" INSERT INTO  " . Self::getTablename() . " (id_asiento, id_funcion, id_boleto) VALUES ({$this->id_asiento}, {$this->id_funcion}, {$this->id_boleto})");
    }
    public function delete():bool{
        return Self::_executeQuery(" DELETE FROM  " . Self::getTablename() . " WHERE id_asiento = " . intval($this->id_asiento) . " AND id_funcion = ".intval($this->id_funcion)." AND id_boleto = ".intval($this->id_boleto));
    }
    public function update():bool{
        return false;
    }

    public static function getAll($atributes=[], $conditions="", $orderBy=""):DBPagination{
        return RolDB::_getRows(Self::class, $atributes, $conditions, $orderBy);
    }

/**
 * Get AsientoReservado por su llave primaria
 *
 * @param array $id - Debe contener un arreglo con 3 llaves id_asiento, id_funcion e id_boleto
 * @return AsientoReservado|null
 */
    static public function getById($id=[]): AsientoReservado|null {
        $id_asiento = intval($id["id_asiento"]);
        $id_funcion = intval($id["id_funcion"]);
        $id_boleto = intval($id["id_boleto"]);
        return Self::transformRow(
            Self::_fetchQuery("SELECT * FROM ".Self::getTablename()." WHERE id_asiento = {$id_asiento} AND id_funcion = {$id_funcion} AND id_boleto = {$id_boleto}", true)
        );
    }
}