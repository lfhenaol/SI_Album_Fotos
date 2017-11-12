<?php

namespace App\Http\Middleware;

use App\DAO\UsuarioDao;
use Closure;

class VerificarPerfil
{
    private $usuarioDao;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $this->usuarioDao = new UsuarioDao();
        $perfil = $this->usuarioDao->obtener_perfil(urldecode($request->header("LSI")));
        if($perfil === FALSE){
            return response()
                ->json(["codigo" => "210", "mensaje"=>"Perfil no válido"]);
        } else {
            $request["id_usuario"] = $perfil["id"];
        }
        return $next($request);
    }
}
