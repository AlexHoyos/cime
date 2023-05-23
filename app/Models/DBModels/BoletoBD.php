<?php

namespace CIME\Models\DBModels;

use CIME\Database\ADBModel;
use CIME\Database\DBPagination;
use CIME\Models\Boleto;
use CIME\Models\Funcion;
use CIME\Models\Pelicula;
use CIME\Models\Usuario;

class BoletoBD extends ADBModel {
    
    public function __construct(
        protected $id,
        protected $id_estado,
        protected $num_adultos,
        protected $num_adols,
        protected $num_ninos,
        protected $id_usuario,
        protected $correo,
        protected $id_funcion,
        protected $es_empleado,
        protected $created_at
    ){}

    public static function getTablename(): String {
        return "boletos";
    }

    public static function transformRow($row): Boleto|null {
            if($row != null)
                return new Boleto($row->id, $row->id_estado, $row->num_adultos, $row->num_adols, $row->num_ninos, $row->id_usuario, $row->correo, $row->id_funcion, $row->es_empleado, $row->created_at);
            
            return null;
    }

    public static function transformRows($rows): Array {
        return ADBModel::_transformRows($rows, Self::class);
    }

    /* CRUD FUNCTIONS */
    public function create():bool {
        $values = [$this->id_estado,  $this->num_adultos, $this->num_adols, $this->num_ninos, $this->id_usuario, "'{$this->correo}'", $this->id_funcion, intval(boolval($this->es_empleado))];
        return Self::_executeQuery(" INSERT INTO  " . Self::getTablename() . " (id_estado, num_adultos, num_adols, num_ninos, id_usuario, correo, id_funcion, es_empleado) VALUES (". implode(", ", $values) . ")");
    }
    public function delete():bool{
        return Self::_executeQuery(" DELETE FROM  " . Self::getTablename() . " WHERE id = " . intval($this->id));
    }
    public function update():bool{
        return Self::_executeQuery("UPDATE ". Self::getTablename() . " SET id_estado = {$this->id_estado}, es_empleado = {$this->es_empleado} WHERE id = " . intval($this->id) );
    }

    public static function getAll($atributes=[], $conditions="", $orderBy=""):DBPagination{
        return Boleto::_getRows(Self::class, $atributes, $conditions, $orderBy);     
    }
    
    static public function getById($id): Boleto|null {
        $id = intval($id);
        return Self::transformRow(
            Self::_fetchQuery("SELECT * FROM ".Self::getTablename()." WHERE id = {$id} ", true)
        );
    }


    /**
     * Obtener el resumen de las ventas fisicas de una fecha determinada
     *  Regresa nulo si no se encuentran ventas o un objeto si las encuentra
     * El objeto contiene los siguientes atributos
     * * adultos
     * * subtotal_adultos
     * * adols
     * * subtotal_adols
     * * ninos
     * * subtotal_ninos
     * @param string $fecha
     * @return object|null
     */
    static public function getResumenVentas($fecha):object|null{
        $usuarioTn = Usuario::getTablename();
        $boletoTn = Self::getTablename();
        $funcionTn = Funcion::getTablename();
        $query = "SELECT SUM(num_adultos) AS adultos, SUM(total_adultos) AS subtotal_adultos, SUM(num_adols) AS adols, SUM(total_adols) AS subtotal_adols, SUM(num_ninos) AS ninos, SUM(total_ninos) AS subtotal_ninos FROM
        (SELECT (precio_adulto*num_adultos) AS total_adultos, (precio_adol*num_adols) AS total_adols, (precio_nino*num_ninos) AS total_ninos , num_adultos, num_adols, num_ninos FROM {$boletoTn}, {$usuarioTn}, {$funcionTn} 
            WHERE {$boletoTn}.id_usuario = {$usuarioTn}.id AND {$funcionTn}.id = {$boletoTn}.id_funcion AND es_empleado = 1 AND {$boletoTn}.created_at = '{$fecha}') precios;";
        return Self::_fetchQuery($query, true);
    }

    /**
     * Obtener ventas fisicas
     *  Regresa un arreglo de boletos fisicos vendidos en la fecha dada
     * Si el arreglo esta vacio, es que no se realizaron ventas
     * @param string $fecha
     * @return array
     */
    static public function getVentas($fecha):array{
        $usuarioTn = Usuario::getTablename();
        $boletoTn = Self::getTablename();
        $query = "SELECT {$boletoTn}.* FROM {$boletoTn}, {$usuarioTn}
            WHERE {$boletoTn}.id_usuario = {$usuarioTn}.id AND es_empleado = 1 AND {$boletoTn}.created_at = '{$fecha}'";
        return Boleto::transformRows( Self::_fetchQuery($query) );

    }

    static public function getIngresosStats($fechaInicio, $fechaFin){
        $boletoTn = Self::getTablename();
        $funcionTn = Funcion::getTablename();
        $query = "SELECT SUM((num_adultos*precio_adulto)+(num_adols*precio_adol)+(num_ninos*precio_nino)) AS subtotal, es_empleado AS fisico FROM {$boletoTn}, {$funcionTn} WHERE {$boletoTn}.id_funcion = {$funcionTn}.id AND created_at BETWEEN '{$fechaInicio}' AND '{$fechaFin}' GROUP BY es_empleado;";
        return Self::_fetchQuery($query);
    }

    static public function getVisitasStats($fechaInicio, $fechaFin){
        $boletoTn = Self::getTablename();
        $funcionTn = Funcion::getTablename();
        $peliculaTn = Pelicula::getTablename();
        $query = "SELECT {$peliculaTn}.titulo, SUM((num_adultos+num_adols+num_ninos)) AS visitas, SUM(num_adultos) as adultos, SUM(num_adols) as adols, SUM(num_ninos) as ninos FROM {$boletoTn}, {$funcionTn}, {$peliculaTn} WHERE {$boletoTn}.id_funcion = {$funcionTn}.id AND {$funcionTn}.id_pelicula = {$peliculaTn}.id AND {$boletoTn}.id_estado = 3 AND {$funcionTn}.fecha BETWEEN '{$fechaInicio}' AND '{$fechaFin}' GROUP BY titulo;";
        return Self::_fetchQuery($query);
    }

    static public function getTiposVentaStats($fechaInicio, $fechaFin){
        $boletoTn = Self::getTablename();
        $query = "SELECT COUNT(*) AS total, SUM(if(id_estado=3, 1, 0)) AS usados, SUM(if(id_estado!=3, 1, 0)) AS no_usados  FROM {$boletoTn} WHERE created_at BETWEEN '{$fechaInicio}' AND '{$fechaFin}';";
        return Self::_fetchQuery($query, true);
    }

    static public function getBoletosByUserId($userID){
        return Self::transformRows(
            Boleto::getAll([], "id_usuario = {$userID} AND es_empleado = 0 AND id_estado != 5", "ORDER BY created_at")->showAll()
        );
    }

}