<?php

namespace CIME\Models;

class MapaSala {

    public function __construct(
        private $asientos,
        private $filas,
        private $columnas
    ){}
    
    public function getHtmlMap():string{
        $HTML = '
        <div class="row m-0 p-0">
            <div class="col-12 d-flex justify-content-center">
                <div class="bg-secondary" style="height:10px; width:'. intval(50*$this->columnas) .'px"></div>
            </div>
        ';

        $idx = 0;
        $asientoActual = (object) $this->asientos[$idx];

        for($i = 1; $i<=$this->filas; $i++){

            $HTML .= '<div class="col-12 d-flex flex-row p-2 justify-content-center">';

            for($j = 1; $j<=$this->columnas; $j++){

                if($asientoActual != null){

                    if($asientoActual->fila == $i && $asientoActual->columna == $j){
                        $HTML .= '<div class="bg-warning text-center p-1 mx-1">' . $asientoActual->nombre . '</div>';
                        if($idx+1 < count($this->asientos))
                            $asientoActual = (object) $this->asientos[++$idx];
                        else
                            $asientoActual = null;
                    } else {
                        $HTML .= '<div id="mapaSala-'.$i.'-'.$j.'" class="bg-dark text-dark text-center p-1 mx-1">---</div>';
                    }

                } else {
                    $HTML .= '<div id="mapaSala-'.$i.'-'.$j.'" class="bg-dark text-dark text-center p-1 mx-1">---</div>';
                }

            }

                $HTML .= '</div>';

        }
        $HTML .= '</div>';

        return $HTML;

    }

    public static function getHtmlMapInput($filas, $columnas, $salaId = 0){

        // CREAMOS EL MAPA EN NEGRO
        $HTML = '
        <div class="row m-0 p-0">
            <div class="col-12 d-flex justify-content-center">
            <div class="bg-secondary" style="height:10px; width:'. intval(50*$columnas) .'px"></div>
            </div>
        ';

        for($i = 1; $i<=$filas; $i++){

            $HTML .= '<div class="col-12 d-flex flex-row p-2 justify-content-center">';

            for($j = 1; $j<=$columnas; $j++){

            
                $HTML .= '<div data-fila="'. $i .'" data-columna="'.$j.'" class="border text-center p-1 mx-1"><input data-asiento="true" type="text" class="form-control p-0" placeholder="*" /></div>';

            }

                $HTML .= '</div>';

        }
        $HTML .= '</div>';

        return $HTML;
    }

}