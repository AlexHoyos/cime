<?php

namespace CIME\Models;

class Session {

    static $instance = null;

    public static function getInstance():Session {
        if(Self::$instance == null)
            Self::$instance = new Session();

        return Self::$instance;
    }

    public function getSessionUser():Usuario|NULL{

        if(isset($_SESSION['uid'])){

            return Usuario::getById(intval($_SESSION['uid']));

        }

        return null;

    }

}