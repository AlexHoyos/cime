<?php

namespace CIME\Filters;

use CIME\Models\Usuario;

class SessionFilter {

    /**
     * Función que indica si existe una sesión de usuario
     *
     * @param [String] $redirectURL Si no existe sesión se dirige al URL indicado, si está vacio no hay redireccionamiento
     * @return bool
     */
    static function existsUserSession($redirectURL= WEB_URL): bool{

        $doRedirect = false;

        if( isset($_SESSION["uid"]) ) {
            
            if(empty($_SESSION["uid"])){
                $doRedirect = true;
            }

        } else {
            $doRedirect = true;
        }

        if($doRedirect && $redirectURL != "")
            header("Location: ".$redirectURL);

        return !$doRedirect;

    }

    /**
     * Función que indica si no existe una sesión de usuario
     *
     * @param [String] $redirectURL Si existe sesión se dirige al URL indicado, si está vacio no hay redireccionamiento
     * @return bool
     */
    static function noExistsUserSession($redirectURL= WEB_URL):bool{

        $doRedirect = false;

        if( isset($_SESSION["uid"]) ){

            if( empty($_SESSION["uid"]) == false )
                $doRedirect = true;

        }

        if($doRedirect && $redirectURL != "")
            header("Location: ".$redirectURL);

        return !$doRedirect;
    }

    /**
     *  Obtener el usuario de la sesión
     *
     * @return Usuario|NULL regresa al usuario si hay sesión o nulo si no hay sesión
     */
    static function getUserBySession():Usuario|NULL {

        $user = NULL;

        if(Self::existsUserSession(""))
            $user = Usuario::getById(intval($_SESSION["uid"]));

        return $user;
    }
//
}
