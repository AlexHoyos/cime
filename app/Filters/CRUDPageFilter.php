<?php

namespace CIME\Filters;

class CRUDPageFilter {

    static function getPageNumber():int{
        $page = 1;
        if(isset($_GET["page"]))
            $page = intval($_GET["page"]);

        if($page == 0)
            $page = 1;
        
        return $page; 
    }

    static function getOrderBy():string{

        $orderBy = "ORDER BY id DESC";

        if(isset($_GET["orderby"])){
            switch($_GET["orderby"]){
                case "old":
                    $orderBy = "ORDER BY id ASC";
                    break;
                default:
                    $orderBy = "ORDER BY id DESC";
            }
        }

        return $orderBy;

    }

    static function getCondition($attr):string{

        $condition = "";
        if(isset($_GET["search"])){
            $condition = $attr . " LIKE \"%". $_GET["search"] ."%\"";
        }

        return $condition;

    }

}

