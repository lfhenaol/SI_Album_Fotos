<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 06/11/2017
 * Time: 09:00 PM
 */

namespace App\DAO;


use Illuminate\Support\Facades\DB;

class AlbumDao implements DaoCRUD
{

    public function insertar($album)
    {
        return DB::transaction(function () use ($album) {
            DB::table('album')->insert([
                [
                    'nombre' => $album->getNombre(),
                    'descripcion' => $album->getDescripcion(),
                    'privacidad'=> $album->getPrivacidad(),
                    'id_usuario' => $album->getIdUsuario(),
                    'fecha_creacion'=> $album->getFechaCreacion()
                ]
            ]);
        });
    }

    public function borrar($album)
    {
        return DB::table('album')->where('id', '=', $album->getIdAlbum())->delete();
    }

    public function actualizar($album)
    {
        return DB::transaction(function () use($album) {
            DB::update('update album set nombre = ?, descripcion = ?, privacidad = ? where id = ?',
                [$album->getNombre(),$album->getDescripcion(), $album->getPrivacidad(), $album->getAlbumId()]);
        });
    }

    public function consultar($id_usuario)
    {
        return DB::table('album')->where('id_usuario',$id_usuario)->get();
    }

    public function listar()
    {
        return DB::select(DB::raw("SELECT al.id, al.nombre, al.descripcion, 
                                  al.privacidad, al.fecha_creacion, pe.nombre as nombre_usuario 
                                  FROM album as al INNER JOIN 
                                  (usuario as us INNER JOIN persona as pe ON us.id_persona = pe.id)
                                   ON us.id_persona = al.id_usuario WHERE al.privacidad = 1")
        );
    }

    public function verificarAlbum($albumImagen){
        return DB::table('album')
            ->where([
                ['id_usuario','=',$albumImagen->getImagen()->getIdUsuario()],
                ['id','=',$albumImagen->getIdAlbum()]
            ])
            ->first();
    }
}