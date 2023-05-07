<?php

namespace CIME\Filters;

use CIME\Models\Rol;
use CIME\Models\Usuario;

class AccountRoleFilter {



    /**
     * Función que indica si la cuenta es de usuario
     *
     * @param [Int] $userId id del usuario
     * @return bool
     */
    static function isUserAccount($userId): bool {
        $user = Usuario::getById($userId);
        if($user != null)
            $rol = $user->getRol();
            if($rol instanceof Rol){

                if($rol->getNombre() == 'usr')
                    return true;
            } else {
                return true;
            }
        return false;

    }

    /**
     * Función que indica si la cuenta es de empleado
     *
     * @param [Int] $userId id del usuario
     * @return bool
     */
    static function isEmpAccount($userId): bool {
        $user = Usuario::getById($userId);
        if($user != null)
            $rol = $user->getRol();
            if($rol instanceof Rol)
                if($rol->getNombre() == 'emp')
                    return true;
        return false;
    }

    /**
     * Función que indica si la cuenta es de admin
     *
     * @param [Int] $userId id del usuario
     * @return bool
     */
    static function isAdminAccount($userId): bool {
        $user = Usuario::getById($userId);
        if($user != null)
            $rol = $user->getRol();
            if($rol instanceof Rol)
                if($rol->getNombre() == 'adm')
                    return true;
        return false;
    }

}
