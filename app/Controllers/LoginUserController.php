<?php

use CIME\Models\Usuario;

include 'ControllerHeader.php';

if(isset($_POST["correo"]) && isset($_POST["contra"])){

    if(!empty($_POST["correo"]) && !empty($_POST["contra"])){

        $posibleUsuario = Usuario::getByEmail($_POST['correo']);

        if($posibleUsuario instanceof Usuario){

            if(password_verify($_POST["contra"], $posibleUsuario->getPassword())){

                $_SESSION["uid"] = $posibleUsuario->getId();
                $httpCode = 200;
                $response["msg"] = "Sesión iniciada";

            } else {
                $httpCode = 422;
                $response["error"] = "Correo o contraseña incorrectos!";
            }

        } else {
            $httpCode = 422;
            $response["error"] = "Correo o contraseña incorrectos!";
        }

    } else {
        $httpCode = 400;
        $response["error"] = "Algunos parametros estan vacios";
    }

} else {
    $httpCode = 400;
    $response["error"] = "No se recibieron todos los parametros esperados";
}

include 'ControllerFooter.php';