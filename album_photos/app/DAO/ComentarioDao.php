<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 06/11/2017
 * Time: 09:00 PM
 */

namespace App\DAO;


use Illuminate\Support\Facades\DB;

class ComentarioDao implements DaoCRUD
{

    public function insertar($comentario)
    {
        return DB::transaction(function () use ($comentario) {
            DB::table('comentario')->insert([
                [
                    'descripcion'   => $comentario->getComentario(),
                    'fecha'         => $comentario->getFechaPublicacion(),
                    'id_imagen'     => $comentario->getIdImagen(),
                    'id_usuario'    => $comentario->getIdUsuario()
                ]
            ]);
        });
    }

    public function borrar($comentario)
    {
        // TODO: Implement borrar() method.
    }

    public function actualizar($comentario)
    {
        // TODO: Implement actualizar() method.
    }

    public function consultar($id_imagen)
    {
        return DB::table('comentario')->where('id_imagen',$id_imagen)->get();
    }

    public function listar()
    {
        //
    }
}