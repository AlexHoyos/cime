<?php

namespace CIME\Models\DBModels;

use CIME\Database\ADBModel;
use CIME\Database\DBPagination;
use CIME\Models\Funcion;

class FuncionDB extends ADBModel {

    public function __construct(
        protected $id,
        protected $mascara_mapa,
        protected $precio_adulto,
        protected $precio_adol,
        protected $precio_nino,
        protected $formato,
        protected $lenguaje,
        protected $subtitulos,
        protected $fecha,
        protected $hora,
        protected $id_sala,
        protected $id_pelicula
    ){}

    protected static function getTablename(): String {
        return "funciones";
    }

    public static function transformRow($row): Funcion|null {
            if($row != null)
                return new Funcion($row->id, $row->mascara_mapa, $row->precio_adulto, $row->precio_adol, $row->precio_nino, $row->formato, $row->lenguaje, $row->subtitulos, $row->fecha, $row->hora, $row->id_sala, $row->id_pelicula);
            
            return null;
    }

    public static function transformRows($rows): Array {
        return ADBModel::_transformRows($rows, Self::class);
    }

    /* CRUD FUNCTIONS */
    public function create():bool {
        $values = [$this->mascara_mapa, $this->precio_adulto, $this->precio_adol, $this->precio_nino, $this->formato, $this->lenguaje, $this->subtitulos, $this->fecha, $this->hora, $this->id_sala, $this->id_pelicula];
        return Self::_executeQuery(" INSERT INTO  " . Self::getTablename() . " (mascara_mapa, precio_adulto, precio_adol, precio_nino, formato, lenguaje, subtitulos, fecha, hora, id_sala, id_pelicula) VALUES (". implode(", ", $values) . ")");
    }
    public function delete():bool{
        return Self::_executeQuery(" DELETE FROM  " . Self::getTablename() . " WHERE id = " . intval($this->id));
    }
    public function update():bool{
        return Self::_executeQuery("UPDATE ". Self::getTablename() . " SET mascara_mapa = {$this->mascara_mapa}, 
            precio_adulto = {$this->precio_adulto}, precio_adol = {$this->precio_adol}, precio_nino = {$this->precio_nino},
            formato = {$this->formato}, lenguaje = {$this->lenguaje}, subtitulos = {$this->subtitulos}, fecha = {$this->fecha},
            hora = {$this->hora}, id_sala = {$this->id_sala}, id_pelicula = {$this->id_pelicula} WHERE id = " . intval($this->id) );
    }

    public static function getAll():DBPagination{
        return Funcion::_getRows(Self::class);     
    }
    
    static public function getById($id): Funcion|null {
        $id = intval($id);
        return Self::transformRow(
            Self::_fetchQuery("SELECT * FROM ".Self::getTablename()." WHERE id = {$id} ")
        );
    }

    

}