<?php

namespace CIME\Filters;

use CIME\Models\Usuario;

class AccountRoleFilter {



    /**
     * Función que indica si la cuenta es de usuario
     *
     * @param [Int] $userId id del usuario
     * @return bool
     */
    static function isUserAccount($userId): bool {
        $user = Usuario::getById(intval($userId));
        return ($user !== NULL && $user->getRole() === 'user');
    }

    /**
     * Función que indica si la cuenta es de empleado
     *
     * @param [Int] $userId id del usuario
     * @return bool
     */
    static function isEmpAccount($userId): bool {
        $user = Usuario::getById(intval($userId));
        return ($user !== NULL && $user->getRole() === 'empleado');
    }

    /**
     * Función que indica si la cuenta es de admin
     *
     * @param [Int] $userId id del usuario
     * @return bool
     */
    static function isAdminAccount($userId): bool {
        $user = Usuario::getById(intval($userId));
        return ($user !== NULL && $user->getRole() === 'admin');
    }

}
