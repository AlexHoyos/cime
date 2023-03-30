<?php

namespace CIME\Utils;

class Captcha {

    static $code;
    static $layer;

    /**
     * GENERADOR DEL CAPTCHA:
     * Establece el valor de la capa de imagen y el codigo del captcha
     * en los atributos estaticos $layer y $code
     * @depends GD LIB
     * @author https://www.positronx.io/create-captcha-in-php-contact-form/
     * @return void
     */
    static function generateCaptcha(){

        // Generate captcha code
        $random_num    = md5(random_bytes(64));
        $captcha_code  = substr($random_num, 0, 6);

        // Create captcha image
        $layer = imagecreatetruecolor(168, 37);
        $captcha_bg = imagecolorallocate($layer, 247, 174, 71);
        imagefill($layer, 0, 0, $captcha_bg);
        $captcha_text_color = imagecolorallocate($layer, 0, 0, 0);
        imagestring($layer, 5, 55, 10, $captcha_code, $captcha_text_color);
        
        Self::$layer = $layer;
        Self::$code = $captcha_code;

    }

}