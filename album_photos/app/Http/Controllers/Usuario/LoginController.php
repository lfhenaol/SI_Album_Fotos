<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 07/09/2017
 * Time: 02:54 PM
 */
namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    function __construct()
    {

    }

    public function validar(){
        return response()->json([
            'metodo' => 'ingresando...'
        ]);
    }
}