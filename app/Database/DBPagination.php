<?php

namespace CIME\Database;

class DBPagination {

    private \PDOStatement $PDOStatement;

    public function __construct(
        private \PDO $dbConn,
        private string $query = "",
        private int $rowsPerPage = 10,
        private $ModelClassName = ADBModel::class
    ){
        $this->query .= " LIMIT :offset, :limit";
        $this->PDOStatement = $dbConn->prepare($this->query);
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

    public function page($number): Array{

        try {

            $offset = $this->rowsPerPage * ($number-1);

            $this->PDOStatement->bindParam(':offset', $offset, \PDO::PARAM_INT);
            $this->PDOStatement->bindParam(':limit', $this->rowsPerPage, \PDO::PARAM_INT);
            $this->PDOStatement->execute();
            
            $rows = $this->PDOStatement->fetchAll(\PDO::FETCH_OBJ);

            return $this->ModelClassName::transformRows($rows);

        } catch(\PDOException $e){
            return [];
        }

    }

}