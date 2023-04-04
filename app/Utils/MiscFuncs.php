<?php

namespace CIME\Utils;

class MiscFuncs {

    /**
     * Creación de cadenas alphanumericas aleatorias
     *
     * @param integer $length Longitud de cadena (Default: 8)
     * @return string
     */
    static function randomAlphaNumeric($length = 8): string {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $string;
    }

}
