<?php

use CIME\Filters\SessionFilter;
use CIME\Models\Usuario;

include '../ControllerHeader.php';

$cuenta = SessionFilter::getUserBySession();

if($cuenta instanceof Usuario){
    
    if(isset($_POST["contra"])){

        if(password_verify($_POST["contra"], $cuenta->getPassword())){

            if(isset($_POST["nombre"]) && isset($_POST["apellido"])){

                $_POST['nombre'] = preg_replace("/[^A-Za-z]/", '', $_POST['nombre']);
                $_POST['apellido'] = preg_replace("/[^A-Za-z]/", '', $_POST['apellido']);

                $httpCode = 422;
                if(strlen($_POST['nombre']) < 3 || strlen($_POST['nombre']) > 50)
                    $response["error"] = "El nombre debe tener entre 3 y 50 caracteres";
                else if(strlen($_POST['apellido']) < 3 || strlen($_POST['apellido']) > 50)
                    $response["error"] = "El apellido debe tener entre 3 y 50 caracteres";
                
                if(isset($response["error"]) == false){

                    $cuenta->setNombre( $_POST["nombre"] );
                    $cuenta->setApellido( $_POST["apellido"] );
                    if($cuenta->update()){
                        $httpCode = 200;
                        $response["msg"] = "Cambios actualizados!";
                    } else {
                        $httpCode = 500;
                        $response["error"] = "Error al actualizar los datos";
                    }

                }

            } else if(isset($_POST["nueva_contra"]) && isset($_POST["repetir_contra"])){

                if($_POST["nueva_contra"] == $_POST["repetir_contra"]){

                    $newPassw = password_hash($_POST["nueva_contra"], PASSWORD_BCRYPT);
                    $cuenta->setPassword($newPassw);
                    if($cuenta->update()){
                        $httpCode = 200;
                        $response["msg"] = "Cambios actualizados!";
                    } else {
                        $httpCode = 500;
                        $response["error"] = "Error al actualizar los datos";
                    }

                } else {
                    $httpCode = 422;
                    $response["error"] = "Las contraseñas no coinciden";
                }

            } else {
                $httpCode = 400;
                $response["error"] = "No se recibieron todos los parametros esperados";
            }

        } else {
            $httpCode = 401;
            $response["error"] = "Contraseña incorrecta!";
        }

    } else {
        $httpCode = 400;
        $response["error"] = "Se debe proporcionar una contraseña para realizar cualquier cambio";
    }

} else {
    $httpCode = 401;
    $response["error"] = "No hay una sesión activa";
}

include '../ControllerFooter.php';