<?php

include_once '../main.php';

use CIME\Utils\Captcha;

// SI NO ESTA HABILITADA LA EXTENSIÓN GD SE ENVIA UN 404
if (get_extension_funcs("gd") == false){
        header("Content-type: image/jpeg");
        http_response_code(404);
        $_SESSION['captcha_code'] = "";
}

// GENERAMOS EL CAPTCHA
Captcha::generateCaptcha();

$_SESSION['captcha_code'] = Captcha::$code;

header("Content-type: image/jpeg");
imagejpeg(Captcha::$layer);