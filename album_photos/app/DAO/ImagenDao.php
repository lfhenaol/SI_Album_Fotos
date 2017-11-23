<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 06/11/2017
 * Time: 09:00 PM
 */

namespace App\DAO;


use Illuminate\Support\Facades\DB;

class ImagenDao implements DaoCRUD
{

    public function insertar($albumImagen)
    {
        return DB::transaction(function () use ($albumImagen) {
            $imagenId = DB::table('imagen')->insertGetId(
                [
                    'titulo'        => $albumImagen->getImagen()->getTitulo(),
                    'foto'          => $albumImagen->getImagen()->getFoto(),
                    'descripcion'   => $albumImagen->getImagen()->getDescripcion(),
                    'fecha_creacion'=> $albumImagen->getImagen()->getFechaCreacion(),
                    'id_usuario'    => $albumImagen->getImagen()->getIdUsuario()
                ]
            );

            DB::table('albumximagen')->insertGetId(
                [
                    'id_imagen' => $imagenId,
                    'id_album'  => $albumImagen->getIdAlbum()
                ]
            );
        });
    }

    public function borrar($imagen)
    {
        // TODO: Implement borrar() method.
    }

    public function actualizar($imagen)
    {
        return DB::table('imagen')
            ->where('id', $imagen->getId())
            ->update([
                'titulo'        => $imagen->getTitulo(),
                'descripcion'   => $imagen->getDescripcion()
            ]);
    }

    public function consultar($id)
    {
        return DB::select(DB::raw("SELECT im.id, im.titulo, im.descripcion, 
                                  im.fecha_creacion, im.foto, us.nickname as nombre_usuario 
                                  FROM albumximagen as alxim INNER JOIN 
                                  (imagen as im INNER JOIN usuario as us ON us.id_persona = im.id_usuario)
                                   ON alxim.id_imagen = im.id WHERE alxim.id_album = {$id}"));
    }

    public function listar()
    {
        return DB::select(DB::raw("SELECT al.nombre, al.descripcion, 
                                  al.privacidad, al.fecha_creacion, us.nickname as nombre_usuario 
                                  FROM album as al INNER JOIN 
                                  (usuario as us INNER JOIN persona as pe ON us.id_persona = pe.id)
                                   ON us.id_persona = al.id_usuario WHERE al.privacidad = 1")
        );
    }
}