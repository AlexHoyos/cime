<?php

namespace CIME\Models;

use CIME\Models\DBModels\FuncionDB;

class Funcion extends FuncionDB {
    
    public function getId(){ return $this->id; }
    public function getPrecioAdulto(){ return $this->precio_adulto; }
    public function getPrecioAdol(){ return $this->precio_adol; }
    public function getPrecioNino(){ return $this->precio_nino; }
    public function getFormato(){ return Formato::getById($this->id_formato); }
    public function getIdioma(){ return Idioma::getById($this->id_idioma); }
    public function getSubtitulos(){ return Idioma::getById($this->id_subtitulos); }
    public function getFecha(){ return $this->fecha; }
    public function getHora(){ return $this->hora; }
    public function getSala(){ return Sala::getById($this->id_sala); }
    public function getPelicula(){ return Pelicula::getById($this->id_pelicula); }

    public function setId($id){ $this->id = $id; }
    public function setPrecioAdulto($precio){ $this->precio_adulto = $precio; }
    public function setPrecioAdol($precio){ $this->precio_adol = $precio; }
    public function setPrecioNino($precio){ $this->precio_nino = $precio; }
    public function setFormato($id_formato){ $this->id_formato = $id_formato; }
    public function setIdioma($id_idioma){ $this->id_idioma = $id_idioma; }
    public function setSubtitulos($id_idioma){
        if($id_idioma == null || $id_idioma == 0)
            $this->id_subtitulos = "NULL";
        else
            $this->id_subtitulos = $id_idioma;
    }
    public function setFecha($fecha){ $this->fecha = $fecha; }
    public function setHora($hora){ $this->hora = $hora; }
    public function setSala($sala){ $this->id_sala = $sala; }
    public function setPelicula($pelicula){ $this->id_pelicula = $pelicula; }

    public function toArray(){
        return [
            "id" => $this->getId(),
            "precio_adulto" => $this->getPrecioAdulto(),
            "precio_adol" => $this->getPrecioAdol(),
            "precio_nino" => $this->getPrecioNino(),
            "titulo_pelicula" => $this->getPelicula()->getTitulo(),
            "fecha" => $this->getFecha(),
            "hora" => $this->getHora(),
            "id_formato" => $this->id_formato,
            "id_pelicula" => $this->id_pelicula,
            "id_idioma" => $this->id_idioma,
            "id_subtitulos" => $this->id_subtitulos,
            "id_sala" => $this->id_sala
        ];
    }

    public static function isHorarioDisponible($sala_id, $hora, $dia, $duracion, $ignoreID = 0):bool{
        $sala_id = intval($sala_id);
        $ignoreCondition = "";
        $ignoreID = intval($ignoreID);
        if($ignoreID > 0)
            $ignoreCondition = " AND funcion.id != {$ignoreID} ";
        $query = "SELECT funciones.id FROM funciones, peliculas, salas WHERE peliculas.id = funciones.id_pelicula AND salas.id = funciones.id_sala AND funciones.id_sala = {$sala_id} AND fecha = '{$dia}' 
                            {$ignoreCondition} 
                            AND ( (hora BETWEEN '{$hora}' AND ADDTIME('{$hora}', sec_to_time({$duracion}*60)))
                            OR (hora BETWEEN ADDTIME('{$hora}', -1*sec_to_time({$duracion}*60)) AND '{$hora}'));";
        $funcion = Funcion::_fetchQuery($query, true);
        return ($funcion == null);
    }

}