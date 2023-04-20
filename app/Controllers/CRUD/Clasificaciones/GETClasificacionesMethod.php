<?php

namespace CIME\Controllers\CRUD\Clasificaciones;

use CIME\Controllers\CRUD\ACRUDControllerMethod;
use CIME\Models\Clasificacion;

class GETClasificacionesMethod extends ACRUDControllerMethod{

    protected function prepare($params = []):void {
        
        if(isset($params["id"])){
            
            $clasificacion = Clasificacion::getById(intval($params["id"]));
            if($clasificacion instanceof Clasificacion){
                
                $this->httpCode = 200;
                $this->response = $clasificacion->toArray();

            } else {
                
                $this->httpCode = 404;
                $this->response["error"] = "No se encontró dicha clasificación";
            }
        } else {
            $page = 1;
            if(isset($params["page"]))
                $page = intval($params["page"]);
            
            $orderBy = "ORDER BY id DESC";

            if(isset($params["orderby"])){
                switch($params["orderby"]){
                    case "old":
                        $orderBy = "ORDER BY id ASC";
                        break;
                    default:
                        $orderBy = "ORDER BY id DESC";
                }
            }

            $this->httpCode = 200;
            $this->response = Clasificacion::getAll([], "", $orderBy)->page($page);
            
        }

    }

}