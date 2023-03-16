<?php

namespace CIME\Database;

class DatabaseConn {

    private \PDO $dbConn;

    public function __construct(
        private String $engine,
        private String $host,
        private Int $port,
        private String $dbname,
        private String $user,
        private String $passw
    ){ $this->createConn(); }


    /**
     * Funcion que crea la conexión a la base de datos
     *
     * @return void
     */
    private function createConn():void {

        try {

            $dsn = $this->engine.":host=".$this->host.";dbname=".$this->dbname.";port=".$this->port;
            $databaseDO = new \PDO($dsn, $this->user, $this->passw);

            $this->dbConn = $databaseDO;

        } catch(\PDOException $e){
            die("No se pudo conectar a la base de datos: " . $e->getMessage());
        }

    }

    /**
     * Función que regresa la conexión creada
     * 
     * @return \PDO
     */

    public function getConnection(): \PDO {
        return $this->dbConn;
    }

}