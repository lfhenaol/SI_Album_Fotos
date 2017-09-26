<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 07/09/2017
 * Time: 02:54 PM
 */
namespace App\Http\Controllers\Usuario;

use App\DAO\UsuarioDao;
use App\Http\Controllers\Controller;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $usuario;
    protected $usuarioDao;

    function __construct()
    {
        $this->usuarioDao = new UsuarioDao();
    }

    public function validar(Request $req){
        $this->usuario = new Usuario($req);
        $usuario_valido = $this->usuario->validar();
        if($usuario_valido === TRUE){
            if($sess = $this->usuarioDao->iniciar($this->usuario)){
                return response()
                    ->json(["codigo" => "0", "mensaje"=>"Ha iniciado sesión correctamente"])
                    ->header('g_s3',$sess);

            } else {
                return response()->json(["codigo"=>"200", "mensaje"=>"El usuario o contraseña son incorrectos"]);
            }
        } else {
            return response()->json($usuario_valido);
        }
    }
}