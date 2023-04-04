<?php

use CIME\Models\Usuario;

include 'ControllerHeader.php';

if(isset($_GET["paso"]) && isset($_GET["correo"])){

    $paso = intval($_GET["paso"]);

    // Verificamos si esta en el primer paso o en el 2do
    if(filter_var($_GET["correo"], FILTER_VALIDATE_EMAIL) != false){

        // Obtenemos al usuario
        $usuario = Usuario::getByEmail($_GET["correo"]);

        if($paso == 1){

            if($usuario instanceof Usuario){
                $codigo = mt_rand(9999999, 99999999);
                $usuario->setSecureCode($codigo);
                $usuario->update();
                $mail->IsHTML(true);
                $mail->AddAddress($usuario->getCorreo(), $usuario->getCorreo());
                $mail->Subject = "Codigo de seguridad";
                $mail->Body = "Tu codigo de seguridad es {$codigo}";
               // mail($usuario->getCorreo(), "Código de seguridad", "Tu codigo de seguridad es {$codigo}");
               $mail->send();
               $mail->smtpClose();
            }

            $httpCode = 200;
            $response["msg"] = "Se ha enviado un codigo al correo";

        } else if($paso == 2){
            
            if(isset($_POST["codigo"]) && isset($_POST["contra"]) && isset($_POST["repetir_contra"])){

                if(!empty($_POST["contra"])){

                    if($_POST["contra"] == $_POST["repetir_contra"]){

                        if($usuario instanceof Usuario){

                            if($usuario->getSecureCode() == $_POST["codigo"]){
                                
                                $usuario->setPassword(password_hash($_POST['contra'], PASSWORD_BCRYPT));
                                $usuario->update();
                                $httpCode = 200;
                                $response["msg"] = "Contraseña actualizada";
        
                            } else {
                                $httpCode = 422;
                                $response["error"] = "Código incorrecto o no existe usuario con ese email {$usuario->getSecureCode()}";
                            }
                            
                        } else {
                            $httpCode = 422;
                            $response["error"] = "Código incorrecto o no existe usuario con ese email";
                        }

                    } else {
                        $httpCode = 422;
                        $response["error"] = "Las contraseñas no coinciden";
                    }

                } else {
                    $httpCode = 422;
                    $response["error"] = "La contraseña no puede estar vacia";
                }

            } else {
                $httpCode = 400;
                $response["error"] = "No se recibio todo el contenido necesario";
            }

        } else {
            $httpCode = 422;
            $response["error"] = "Paso invalido!";
        }

    } else {
        $httpCode = 422;
        $response["error"] = "Correo invalido";
    }

} else {
    $httpCode = 400;
    $response["error"] = "No se recibieron todos los parametros requeridos";
}

include 'ControllerFooter.php';