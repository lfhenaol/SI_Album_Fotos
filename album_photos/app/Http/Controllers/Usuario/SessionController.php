<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 25/09/2017
 * Time: 11:52 AM
 */

namespace App\Http\Controllers\Usuario;

use App\DAO\UsuarioDao;
use App\Http\Controllers\Controller;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    protected $usuarioDao;

    function __construct()
    {
        $this->usuarioDao = new UsuarioDao();
    }

    function validar(Request $request){
        if($perfil = $this->usuarioDao->obtener_perfil(urldecode($request->header("LSI")))){
            return response()
                ->json(["codigo" => "0", "mensaje"=>"Perfil válido", "datos"=>$perfil]);
        } else {
            return response()
                ->json(["codigo" => "210", "mensaje"=>"Perfil no válido"]);
        }
    }
}