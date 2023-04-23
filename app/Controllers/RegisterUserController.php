<?php

include 'ControllerHeader.php';

use CIME\Models\Usuario;

if( isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['correo']) && isset($_POST['telefono']) && isset($_POST['nacimiento']) 
    && isset($_POST['contra']) && isset($_POST['repetir_contra']) && isset($_POST['captcha']) ){

        if( !empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['correo']) && !empty($_POST['telefono']) && !empty($_POST['nacimiento']) 
            && !empty($_POST['contra']) && !empty($_POST['repetir_contra']) && !empty($_POST['captcha']) ){


                if(isset($_SESSION['captcha_code']) == false){
                    $httpCode = 401;
                    $response["error"] = "Debe primero generar un captcha";
                }

                if(empty($_SESSION['captcha_code'])){
                    $httpCode = 401;
                    $response["error"] = "Debe primero generar un captcha";
                }

                /*
                LIMPIAMOS LOS INPUTS
                */
                $_POST['nombre'] = preg_replace("/[^A-Za-z]/", '', $_POST['nombre']);
                $_POST['apellido'] = preg_replace("/[^A-Za-z]/", '', $_POST['apellido']);
                $_POST['telefono'] = intval(preg_replace("/[^0-9]/", '', $_POST['telefono']));
                $nacimiento = explode('-',$_POST['nacimiento']);
                if(count($nacimiento) == 3){
                    $nacimiento["anio"] = intval($nacimiento[0]);
                    $nacimiento["mes"] = intval($nacimiento[1]);
                    $nacimiento["dia"] = intval($nacimiento[2]);
                } else {
                    $nacimiento["anio"] = 0;
                    $nacimiento["mes"] = 0;
                    $nacimiento["dia"] = 0;
                }
                $nacimientoStr = $nacimiento['anio']."-".$nacimiento['mes']."-".$nacimiento['dia'];
                $edadUsuario = floor((time() - strtotime($nacimientoStr)) / 31556926);
                /*
                VALIDACIONES DE INPUTS
                */

                $httpCode = 422;

                if(strlen($_POST['nombre']) < 3 || strlen($_POST['nombre']) > 50)
                    $response["error"] = "El nombre debe tener entre 3 y 50 caracteres";
                else if(strlen($_POST['apellido']) < 3 || strlen($_POST['apellido']) > 50)
                    $response["error"] = "El apellido debe tener entre 3 y 50 caracteres";
                else if(strlen($_POST['correo']) > 80)
                    $response['error'] = "El correo no debe ser mayor a 50 caracteres";
                else if(filter_var($_POST["correo"], FILTER_VALIDATE_EMAIL) == false)
                    $response["error"] = "El correo no es valido!";
                else if( Usuario::getByEmail($_POST['correo']) instanceof Usuario )
                    $response["error"] = "El correo ya está en uso";
                else if($_POST['telefono'] <= 999999999 || $_POST['telefono'] > 9999999999)
                    $response["error"] = "Telefono invalido! Sólo permitido 10 caracteres {$_POST["telefono"]}";
                else if(checkdate($nacimiento['mes'], $nacimiento['dia'], $nacimiento['anio']) == false)
                    $response["error"] = "Fecha de nacimiento invalida!";
                else if($edadUsuario < 18)
                    $response["error"] = "Sólo mayores de 18 años pueden registrarse en el sitio!";
                else if($edadUsuario >= 150)
                    $response["error"] = "Fecha de nacimiento invalida!";
                else if($_POST['contra'] != $_POST['repetir_contra'])
                    $response["error"] = "Las contraseñas no coinciden";
                else if($_POST['captcha'] != $_SESSION['captcha_code'])
                    $response["error"] = "Captcha incorrecto";

                // SI NO HAY ERROR CREA EL USUARIO
                if(isset($response["error"]) == false){

                     // ENCRIPTAMOS CONTRASEÑA
                    $password = password_hash($_POST['contra'], PASSWORD_BCRYPT);

                    // CREAMOS AL USUARIO
                    $nuevoUsuario = new Usuario(NULL, $_POST['nombre'], $_POST['apellido'], $_POST['correo'], $_POST['telefono'], $nacimientoStr, $password, NULL, 1, NULL);
                    if($nuevoUsuario->create()){
                        $_SESSION["captcha_code"] = "";
                        $httpCode = 201;
                        $response["msg"] = "Usuario creado! Inicia sesión";
                    } else {
                        $httpCode = 500;
                        $response["error"] = "Algo salió mal al crear el usuario!";
                    }

                }

            } else {
                $httpCode = 400;
                $response["error"] = "Algunos parametros estan vacios";
            }

} else {
    $httpCode = 400;
    $response["error"] = "No se recibieron algunos parametros esperados";
}

include 'ControllerFooter.php';