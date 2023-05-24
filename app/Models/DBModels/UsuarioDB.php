<?php

namespace CIME\Models\DBModels;

use CIME\Database\ADBModel;
use CIME\Database\DBPagination;
use CIME\Models\Boleto;
use CIME\Models\Funcion;
use CIME\Models\Usuario;

class UsuarioDB extends ADBModel {

    public function __construct(
        protected $id,
        protected $nombre,
        protected $apellido,
        protected $correo,
        protected $telefono,
        protected $nacimiento,
        protected $password,
        protected $reg_date,
        protected $id_rol,
        protected $secure_code
    ){}

    public static function getTablename(): String {
        return "usuarios";
    }

    public static function transformRow($row): Usuario|null {
            if($row != null)
                return new Usuario($row->id, $row->nombre, $row->apellido, $row->correo, $row->telefono,
                    $row->nacimiento, $row->password, $row->reg_date, $row->id_rol, $row->secure_code);
            
            return null;
    }

    public static function transformRows($rows): Array {
        return ADBModel::_transformRows($rows, Self::class);
    }

    /* CRUD FUNCTIONS */
    public function create():bool {
        $values = ["'{$this->nombre}'", "'{$this->apellido}'", "'{$this->correo}'", $this->telefono, "'{$this->nacimiento}'", "'{$this->password}'", $this->id_rol];
        return Self::_executeQuery(" INSERT INTO  " . Self::getTablename() . " (nombre, apellido, correo, telefono, nacimiento, password, id_rol) VALUES (". implode(", ", $values) . ")");
    }
    public function delete():bool{
        return Self::_executeQuery(" DELETE FROM  " . Self::getTablename() . " WHERE id = " . intval($this->id));
    }
    public function update():bool{
        return Self::_executeQuery("UPDATE ". Self::getTablename() . " SET nombre = '{$this->nombre}', apellido = '{$this->apellido}', password = '{$this->password}', id_rol = {$this->id_rol}, secure_code = {$this->secure_code} WHERE id = " . intval($this->id) );
    }


    /**
     * Obtener el resumen de las ventas de un usuario en una fecha determinada
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
    public function getResumenVentas($fecha, $all = false):object|null{
        $usuarioTn = Self::getTablename();
        $boletoTn = Boleto::getTablename();
        $funcionTn = Funcion::getTablename();
        $usuario = "";
        if($all == false){
            $usuario = "AND {$boletoTn}.id_usuario = {$this->id}";
        }
        $query = "SELECT SUM(num_adultos) AS adultos, SUM(total_adultos) AS subtotal_adultos, SUM(num_adols) AS adols, SUM(total_adols) AS subtotal_adols, SUM(num_ninos) AS ninos, SUM(total_ninos) AS subtotal_ninos FROM
        (SELECT (precio_adulto*num_adultos) AS total_adultos, (precio_adol*num_adols) AS total_adols, (precio_nino*num_ninos) AS total_ninos , num_adultos, num_adols, num_ninos FROM {$boletoTn}, {$usuarioTn}, {$funcionTn} 
            WHERE {$boletoTn}.id_usuario = {$usuarioTn}.id AND {$funcionTn}.id = {$boletoTn}.id_funcion AND es_empleado = 1 {$usuario} AND {$boletoTn}.created_at = '{$fecha}') precios;";
        return Self::_fetchQuery($query, true);
    }

    /**
     * Obtener ventas de un usuario
     *  Regresa un arreglo de boletos vendidos en la fecha dada
     * Si el arreglo esta vacio, es que no se realizaron ventas
     * @param string $fecha
     * @return array
     */
    public function getVentas($fecha, $all = false):array{
        $usuarioTn = Self::getTablename();
        $boletoTn = Boleto::getTablename();
        $usuario = "";
        if($all == false){
            $usuario = "AND {$boletoTn}.id_usuario = {$this->id}";
        }
        $query = "SELECT {$boletoTn}.* FROM {$boletoTn}, {$usuarioTn}
            WHERE {$boletoTn}.id_usuario = {$usuarioTn}.id AND es_empleado = 1 {$usuario} AND {$boletoTn}.created_at = '{$fecha}'";
        return Boleto::transformRows( Self::_fetchQuery($query) );
    }

    static public function getAll():DBPagination{
        return Usuario::_getRows(Self::class);     
    }
    
    static public function getById($id): Usuario|null {
        $id = intval($id);
        return Self::transformRow(
            Self::_fetchQuery("SELECT * FROM ".Self::getTablename()." WHERE id = {$id} ", true)
        );
    }

    static public function getByEmail($email): Usuario|null {
        return Self::transformRow(
            Self::_fetchQuery("SELECT * FROM ".Self::getTablename()." WHERE correo = '{$email}' ", true)
        );
    }


}