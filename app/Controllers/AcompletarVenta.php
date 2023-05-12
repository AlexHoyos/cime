<?php

use CIME\Models\Boleto;

include_once '../main.php';

if(isset($_GET["boleto_id"], $_GET["PayerID"], $_GET["paymentId"])){

    $transaccion = $gateway->completePurchase([
        "payer_id" => $_GET["PayerID"],
        "transactionReference" => $_GET["paymentId"]
    ]);

    $response = $transaccion->send();
    $boleto = Boleto::getById(intval($_GET["boleto_id"]));
    if($boleto instanceof Boleto){
        if($response->isSuccessful()){

            $boleto->setEstado(1);
            $boleto->update();
            header("Location: ".WEB_URL."/boleto.php?id=".$boleto->getId()."&correo=".$boleto->getCorreo());
    
        } else {
    
            // ELIMINAR BOLETO Y ASIENTOS
            $boleto->delete();
            die("Error en el pago:(! Sí se trata de un error comunicate con nosotros. ID DE TRANSACCION:".$_GET["paymentId"]);
        }

    } else {
        // Error boleto no existe
        die("Boleto no existe");
    }


}