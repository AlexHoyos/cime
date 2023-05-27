<?php

use CIME\Models\Boleto;

include_once '../main.php';

if(isset($_GET["boleto_id"])){

    $boleto = Boleto::getById(intval($_GET["boleto_id"]));
    if($boleto instanceof Boleto){
        $funcion_id = $boleto->getFuncion();
        $boleto->delete();
        header("Location: ".WEB_URL."/reservar.php?funcion=".$funcion_id."&step=4&error=Compra cancelada por cliente");
    } else {
        header("Location: ".WEB_URL);
    }


} else {
    header("Location: ".WEB_URL);
}