<?php

namespace CIME\Database;

use PDOException;

class DBPagination {

    private \PDOStatement $PDOStatement;

    public function __construct(
        private \PDO $dbConn,
        private string $query = "",
        private int $rowsPerPage = 10,
        private $ModelClassName = ADBModel::class
    ){
        $this->query .= " LIMIT :offset, :limit";
        $this->query = str_replace("  ", " ", $this->query);
    }

    public function totalRows(): int{
        $this->PDOStatement->execute();
        return $this->PDOStatement->rowCount();
    }

    public function totalPages(): int {
        return intval(ceil($this->totalRows()/$this->rowsPerPage));
    }

    public function setRowsPerPage(int $number):void{
        $this->rowsPerPage = $number;
    }

    public function showAll(): array {
        try {

            $newQuery = str_replace("LIMIT :offset, :limit", "", $this->query);
            $this->PDOStatement = $this->dbConn->prepare($newQuery);
            $this->PDOStatement->execute();
            
            $rows = $this->PDOStatement->fetchAll(\PDO::FETCH_ASSOC);
            return $rows;

        } catch(PDOException $e){
            return [];
        }
    }

    public function page($number): Array{

        try {

            $offset = $this->rowsPerPage * ($number-1);
            
            $newQuery = $this->query;
            $newQuery = str_replace(":offset", intval($offset), $newQuery);
            $newQuery = str_replace(":limit", intval($this->rowsPerPage), $newQuery);
            $this->PDOStatement = $this->dbConn->prepare($newQuery);
            $this->PDOStatement->execute();
            
            $rows = $this->PDOStatement->fetchAll(\PDO::FETCH_ASSOC);
            return $rows;

        } catch(\PDOException $e){
            var_dump($e);
            return [];
        }

    }

}