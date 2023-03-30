<?php

namespace CIME\Filters;

class SessionFilter {

    static function existsUserSession($redirectURL= WEB_URL){

        $doRedirect = false;

        if( isset($_SESSION["uid"]) ) {
            
            if(empty($_SESSION["uid"])){
                $doRedirect = true;
            }

        } else {
            $doRedirect = true;
        }

        if($doRedirect)
            header("Location: ".$redirectURL);

    }

    static function noExistsUserSession($redirectURL= WEB_URL){

        $doRedirect = false;

        if( isset($_SESSION["uid"]) ){

            if( empty($_SESSION["uid"]) == false )
                $doRedirect = true;

        }

        if($doRedirect)
            header("Location: ".$redirectURL);

    }

}