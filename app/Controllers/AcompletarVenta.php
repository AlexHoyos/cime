<?php

use chillerlan\QRCode\QRCode;
use CIME\Filters\SessionFilter;
use CIME\Models\Asiento;
use CIME\Models\AsientoReservado;
use CIME\Models\Boleto;
use CIME\Models\Usuario;

include_once '../main.php';

if(isset($_GET["boleto_id"])){

    $userSession = SessionFilter::getUserBySession();
    $boleto = Boleto::getById(intval($_GET["boleto_id"]));

    if($userSession instanceof Usuario && $boleto instanceof Boleto){
        if(isset($_GET["admin"]) && $userSession->getRol()->getId() > 1){
            
            header("Location: ".WEB_URL."/admin/boleto.php?id=".$boleto->getId());
        }
    }

    if(isset($_GET["PayerID"], $_GET["paymentId"])){

        $transaccion = $gateway->completePurchase([
            "payer_id" => $_GET["PayerID"],
            "transactionReference" => $_GET["paymentId"]
        ]);
    
        $response = $transaccion->send();
        
        if($boleto instanceof Boleto){
            if($response->isSuccessful()){
    
                $asientos = AsientoReservado::getAsientosFromBoletoId($boleto->getId());
                $nombreAsientos = [];
                foreach($asientos as $asiento){
                    $nombreAsientos[] = $asiento->getNombre();
                }
                $nombreAsientos = implode(",", $nombreAsientos);
    
                $funcion = $boleto->getFuncionInstance();
                $sala = $funcion->getSala();
                $peli = $funcion->getPelicula();
    
                $qrcode = (new QRCode($QRoptions))->render($boleto->getId());
    
                $boleto->setEstado(1);
                $boleto->update();
    
                $mail->IsHTML(true);
                $mail->AddAddress($boleto->getCorreo());
                $mail->Subject = "Confirmación de compra!";
                $mail->Body = "<h3>¡Gracias por tu confianza! Aquí tienes tu boleto digital </h3>";
                $mail->Body .= "<p><b>Pelicula: </b> ".$peli->getTitulo()." </p>";
                $mail->Body .= "<p><b>Adultos: </b> ".$boleto->getNumAdultos() ." </p>";
                $mail->Body .= "<p><b>Adolescentes: </b> ".$boleto->getNumAdols() ." </p>";
                $mail->Body .= "<p><b>Niños: </b> ". $boleto->getNumNinos() ." </p>";
                $mail->Body .= "<p><b>Asientos: </b> ".$nombreAsientos." </p>";
                $mail->Body .= "<hr>";
                $mail->Body .= "<p><b>Fecha: </b> ".$funcion->getFecha() ." </p>";
                $mail->Body .= "<p><b>Hora: </b> ".$funcion->getHora() ." </p>";
                $mail->Body .= "<p><b>Sala: </b> ".$sala->getNombre() ." </p>";
                $mail->Body .= "<p><b>ID Boleto: </b> ".$boleto->getId() ." </p>";
                $mail->Body .= "<hr>";
                $mail->Body .= "<img src=\"cid:qrcode_1\" height=\"200\" alt=\"Boleto QR\" />";
                // mail($usuario->getCorreo(), "Código de seguridad", "Tu codigo de seguridad es {$codigo}");
                $mail->addStringEmbeddedImage(base64_decode($qrcode), 'qrcode_1', 'codigo_qr.png');
                $mail->send();
                $mail->smtpClose();
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


}