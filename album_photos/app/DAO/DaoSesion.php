<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 07/09/2017
 * Time: 02:31 PM
 */

namespace App\DAO;

use App\Usuario;

interface DaoSesion {
    public function iniciar(Usuario $usuario);
    public function cerrar();
}