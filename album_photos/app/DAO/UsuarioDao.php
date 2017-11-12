<?php
/**
 * Created by PhpStorm.
 * User: Lucho
 * Date: 07/09/2017
 * Time: 01:42 AM
 */

namespace App\DAO;

use App\Persona;
use App\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsuarioDao implements DaoSesion, DaoCRUD
{
    public function iniciar(Usuario $usuario)
    {
        $consulta = DB::table('usuario')
            ->select('usuario.contrasenia')
            ->where([
                ['usuario.nickname','=',$usuario->getNickname()]
            ])
            ->first();

        if($consulta && Hash::check($usuario->getContrasenia(),$consulta->contrasenia)){
            $session = Session::getId();
            session(['sesion_usuario' => encrypt($session)]);
            DB::table('usuario')
                ->where('nickname',$usuario->getNickname())
                ->update(
                    ['sesion_usuario' => $session]
                );
            return session("sesion_usuario");
        }

        return FALSE;
    }

    public function cerrar()
    {
    }

    /**
     * @param $id
     * @return mixed
     */
    public function consultar($id)
    {
        return DB::table('usuario')
            ->join('persona', 'usuario.id_persona','=','persona.id')
            ->select('persona.nombre', 'persona.avatar', 'persona.id')
            ->where('usuario.nickname','=',$id)
            ->first();
    }

    /**
     * @param Persona $usuario
     */
    public function insertar($usuario)
    {
        DB::transaction(function () use ($usuario) {
            $id_persona = DB::table('persona')->insertGetId(
                ['nombre' => $usuario->getNombre(), 'avatar' => $usuario->getAvatar(), 'tipo' => $usuario->getTipo()]
            );
            DB::table('usuario')->insert([
                ['id_persona' => $id_persona, 'nickname' => $usuario->getUsuario()->getNickname(), 'contrasenia' => bcrypt($usuario->getUsuario()->getContrasenia())]
            ]);
        });
    }

    public function borrar()
    {
        // TODO: Implement borrar() method.
    }

    public function actualizar()
    {
        // TODO: Implement actualizar() method.
    }

    public function listar()
    {
        // TODO: Implement listar() method.
    }

    /**
     * @param $session_id
     * @return bool|array
     */
    public function obtener_perfil($session_id)
    {


        try {
            $consulta = DB::table('usuario')
                ->select('usuario.nickname')
                ->where([
                    ['usuario.sesion_usuario','=', decrypt($session_id)]
                ])
                ->first();

            settype($consulta, "object");

            $perfil = $this->consultar($consulta->nickname);
            settype($perfil, "array");

            if($perfil){
                return $perfil;
            }

        } catch (\Exception $e) {
            return FALSE;
        }

        return FALSE;
    }
}