<?php
/**
 * Created by PhpStorm.
 * User: Lucho
 * Date: 07/09/2017
 * Time: 12:26 AM
 */

namespace app\DaoCRUD;


interface DaoCRUD
{
    public function insertar();
    public function borrar();
    public function actualizar();
    public function consultar();
    public function listar();
}