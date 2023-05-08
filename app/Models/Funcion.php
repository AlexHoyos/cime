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

    /**
     * Obtener las funciones disponibles de una pelicula
     *
     * Si se elige el modo con formato entonces las funciones se dividen en grupos
     * Los grupos se nombran por [ID_FORMATO]_[ID_IDIOMA]_[ID_SUBTITULOS]
     * Puedes usar la funcion estatica getDescriptionGrupoFunciones($nombreGrupo) para obtener una descripcion del grupo
     * 
     * @param int $peliculaId
     * @param string $fecha
     * @param int $formatoID - Filtro por tipo de formato
     * @param int $idiomaID - Filtro por idioma
     * @param int $subID - Filtro por subtitulos
     * @param boolean $formated - Si es verdad entonces se regresa un arreglo ordenado y filtrado de las peliculas
     * @return array
     */
    public static function getFuncionesPelicula($peliculaId, $formatoID = 0, $idiomaID = 0, $subID = 0, $fecha = "", $formated = false){
        if($fecha == "")
            $fecha = date('Y-m-d');

        $peliculaId = intval($peliculaId);
        $filters = "";

        if($formatoID > 0)
            $filters .= "AND id_formato={$formatoID} ";
        if($idiomaID > 0)
            $filters .= "AND id_idioma={$idiomaID} ";
        if($subID > 0)
            $filters .= "AND id_subtitulos={$subID}";

        $funcionTablename = Self::getTablename();
        $query = "SELECT * FROM {$funcionTablename} WHERE fecha = '{$fecha}' AND id_pelicula = {$peliculaId} {$filters}";
        $rows = Funcion::_fetchQuery($query);

        $funciones = [];
        if($formated){

            foreach($rows as $funcion){
                $funcion = (object) $funcion;
                $groupName = $funcion->id_formato."_".$funcion->id_idioma."_".intval($funcion->id_subtitulos);
                $funciones[$groupName][] = $funcion;
            }

        } else {
            $funciones = $rows;
        }

        return $funciones;

    }

    public static function getDescriptionGrupoFunciones($groupName){
        $data = explode("_", $groupName);
        $formatoID = $data[0];
        $idiomaID = $data[1];
        $subID = $data[2];

        $formatoName = Formato::getById($formatoID)->getNombre();
        $idiomaName = strtoupper(Idioma::getById($idiomaID)->getNombre());
        
        $descripcion = "{$formatoName} - {$idiomaName}";
        if($subID != 0){
            $subName = strtoupper(Idioma::getById($subID)->getNombre());
            $descripcion .= " SUB {$subName}";
        }

        return $descripcion;

    }

}