<?php

namespace CIME\Controllers\CRUD;

abstract class ACRUDControllerMethod {

    protected $httpCode = 500;
    protected $response = [];

    abstract protected function prepare($params = []): void;

    /**
     * Función para ejecutar el metodo HTTP
     *
     * @param array $params Argumentos o parametros recibidos en la petición HTTP
     * @param boolean $restriction Condición que se debe cumplir para poder ejecutar la petición
     * @return void
     */
    public function execute($params = [], $restriction = true){

        if($restriction){

            $this->prepare($params);

        } else {
            $this->httpCode = 401;
            $this->response["error"] = "No tiene autorización para realizar dicha acción";
        }

    }

    public function getHttpCode():int {
        return $this->httpCode;
    }

    public function getResponse(): array{
        return $this->response;
    }

}