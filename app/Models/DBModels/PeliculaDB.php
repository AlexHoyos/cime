<?php

namespace CIME\Models\DBModels;

use CIME\Database\ADBModel;
use CIME\Database\DBPagination;
use CIME\Models\Pelicula;

class PeliculaDB extends ADBModel {

    public function __construct(
        protected $id,
        protected $titulo,
        protected $sinopsis,
        protected $portada,
        protected $wallpaper,
        protected $duracion,
        protected $id_clasificacion
    ){}

    protected static function getTablename(): String {
        return "peliculas";
    }

    public static function transformRow($row): Pelicula|null {
            if(sizeof($row) > 0)
                return new Pelicula($row->id, $row->titulo, $row->sinopsis, $row->portada, $row->wallpaper, $row->duracion, $row->id_clasificacion);
            
            return null;
    }

    public static function transformRows($rows): Array {
        return ADBModel::_transformRows($rows, Self::class);
    }

    /* CRUD FUNCTIONS */
    public function create():bool {
        $values = [$this->titulo, $this->sinopsis, $this->portada, $this->wallpaper, $this->duracion, $this->id_clasificacion];
        return Self::_executeQuery(" INSERT INTO  " . Self::getTablename() . " (titulo, sinopsis, portada, wallpaper, duracion, id_clasificacion) VALUES (". implode(", ", $values) . ")");
    }
    public function delete():bool{
        return Self::_executeQuery(" DELETE FROM  " . Self::getTablename() . " WHERE id = " . intval($this->id));
    }
    public function update():bool{
        return Self::_executeQuery("UPDATE ". Self::getTablename() . " SET titulo = {$this->titulo}, sinopsis = {$this->sinopsis}, portada = {$this->portada}, wallpaper = {$this->wallpaper}, duracion = {$this->duracion}, id_clasificacion = {$this->id_clasificacion} WHERE id = " . intval($this->id) );
    }

    public static function getAll():DBPagination{
        return Pelicula::_getRows(Self::class);     
    }
    
    static public function getById($id): Pelicula|null {
        $id = intval($id);
        return Self::transformRow(
            Self::_fetchQuery("SELECT * FROM ".Self::getTablename()." WHERE id = {$id} ")
        );
    }

    

}