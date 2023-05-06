<?php

namespace CIME\Models\DBModels;

use CIME\Database\ADBModel;
use CIME\Database\DBPagination;
use CIME\Models\Funcion;

class FuncionDB extends ADBModel {

    public function __construct(
        protected $id,
        protected $precio_adulto,
        protected $precio_adol,
        protected $precio_nino,
        protected $id_formato,
        protected $id_idioma,
        protected $id_subtitulos,
        protected $fecha,
        protected $hora,
        protected $id_sala,
        protected $id_pelicula
    ){}

    public static function getTablename(): String {
        return "funciones";
    }

    public static function transformRow($row): Funcion|null {
            if($row != null)
                return new Funcion($row->id, $row->precio_adulto, $row->precio_adol, $row->precio_nino, $row->id_formato, $row->id_idioma, $row->id_subtitulos, $row->fecha, $row->hora, $row->id_sala, $row->id_pelicula);
            
            return null;
    }

    public static function transformRows($rows): Array {
        return ADBModel::_transformRows($rows, Self::class);
    }

    /* CRUD FUNCTIONS */
    public function create():bool {
        $values = [$this->precio_adulto, $this->precio_adol, $this->precio_nino, $this->id_formato, $this->id_idioma, ($this->id_subtitulos == null) ? "NULL":$this->id_subtitulos, "'".$this->fecha."'", "'".$this->hora."'", $this->id_sala, $this->id_pelicula];
        return Self::_executeQuery(" INSERT INTO  " . Self::getTablename() . " (precio_adulto, precio_adol, precio_nino, id_formato, id_idioma, id_subtitulos, fecha, hora, id_sala, id_pelicula) VALUES (". implode(", ", $values) . ")");
    }
    public function delete():bool{
        return Self::_executeQuery(" DELETE FROM  " . Self::getTablename() . " WHERE id = " . intval($this->id));
    }
    public function update():bool{
        return Self::_executeQuery("UPDATE ". Self::getTablename() . " SET  precio_adulto = {$this->precio_adulto}, precio_adol = {$this->precio_adol}, 
            precio_nino = {$this->precio_nino}, id_formato = {$this->id_formato}, id_idioma = {$this->id_idioma}, id_subtitulos = {$this->id_subtitulos},
            fecha = '{$this->fecha}', hora = '{$this->hora}', id_sala = {$this->id_sala}, id_pelicula = {$this->id_pelicula} WHERE id = " . intval($this->id) );
    }

    public static function getAll($atributes=[], $conditions="", $orderBy=""):DBPagination{
        return Funcion::_getRows(Self::class, $atributes, $conditions, $orderBy);     
    }
    
    static public function getById($id): Funcion|null {
        $id = intval($id);
        return Self::transformRow(
            Self::_fetchQuery("SELECT * FROM ".Self::getTablename()." WHERE id = {$id} ", true)
        );
    }

    

}