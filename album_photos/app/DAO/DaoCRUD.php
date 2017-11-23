<?php
/**
 * Created by PhpStorm.
 * User: Lucho
 * Date: 07/09/2017
 * Time: 12:26 AM
 */

namespace App\DAO;


use App\Usuario;

interface DaoCRUD
{
    public function insertar($form);
    public function borrar($form);
    public function actualizar($form);
    public function consultar($id);
    public function listar();
}