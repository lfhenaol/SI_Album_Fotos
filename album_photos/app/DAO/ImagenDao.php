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

    public function borrar()
    {
        // TODO: Implement borrar() method.
    }

    public function actualizar()
    {
        // TODO: Implement actualizar() method.
    }

    public function consultar($id)
    {
        return DB::table('albumximagen')
            ->select('imagen.titulo', 'imagen.descripcion', 'imagen.fecha_creacion', 'imagen.foto')
            ->join('imagen','albumximagen.id_imagen','=','imagen.id')
            ->where('albumximagen.id_album',$id)
            ->get();
    }

    public function listar()
    {
        return DB::select(DB::raw("SELECT al.nombre, al.descripcion, 
                                  al.privacidad, al.fecha_creacion, pe.nombre as nombre_usuario 
                                  FROM album as al INNER JOIN 
                                  (usuario as us INNER JOIN persona as pe ON us.id_persona = pe.id)
                                   ON us.id_persona = al.id_usuario WHERE al.privacidad = 1")
        );
    }
}