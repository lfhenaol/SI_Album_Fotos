<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 07/09/2017
 * Time: 02:54 PM
 */

namespace App\Http\Controllers\Usuario;

use App\DAO\UsuarioDao;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Persona;
use App\Usuario;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RegistroController extends Controller
{
    protected $persona;
    protected $usuarioDao;

    public function __construct()
    {
        $this->usuarioDao = new UsuarioDao();
    }

    public function registrar(Request $req){
        $this->persona = new Persona($req);
        $persona_valida = $this->persona->validar();
        if($persona_valida === TRUE){
            $this->usuarioDao->insertar($this->persona);
            return response()->json(['codigo' => '0', 'mensaje' => 'Registro completado exitosamente']);
        } else {
            return response()->json($persona_valida);
        }
    }
}