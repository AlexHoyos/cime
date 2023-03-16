<?php

namespace CIME\Database;

abstract class ADBModel {

    public static \PDO $dbConn;
    protected $class = Self::class;

    abstract protected static function getTablename(): String;
    abstract public static function transformRow($row): ADBModel|null;
    abstract public static function transformRows($rows): Array;
    /* CRUD FUNCTIONS */ 
    abstract public function create():bool;
    abstract public function delete():bool;
    abstract public function update():bool;

    abstract protected static function getAll():DBPagination;
    abstract public static function getById($id): ADBModel|null;

    protected static function _getRows($class = Self::class, $atributes = [], $conditions = "", $orderBy = ""):DBPagination {

        if(sizeof($atributes) == 0)
            $atributes = "*";
        else
            $atributes = implode(",", $atributes);

        if($conditions != "")
            $conditions = "WHERE ".$conditions;

        $stmt = "SELECT {$atributes} FROM " . $class::getTablename() . " {$conditions} {$orderBy}";
        
        return new DBPagination(ADBModel::$dbConn, $stmt, 10, $class);

    }

    protected static function _fetchQuery(String $query): Array{
        try {

            $stmt = ADBModel::$dbConn->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
            return $rows;

        } catch(\PDOException $e){
            return [];
        }
    }

    protected static function _executeQuery(string $query): bool {
        try {

            $stmt = ADBModel::$dbConn->prepare($query);
            return $stmt->execute();

        } catch(\PDOException $e){
            return false;
        }
    }

    protected static function _transformRows(array $rows, $class = Self::class): Array {

        $transformedRows = [];

        foreach($rows as $row){
            $transformedRows[] = $class::transformRow($row);
        }

        return $transformedRows;

    }


}