<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 12/11/2017
 * Time: 01:41 PM
 */

namespace app\Http\Controllers\Album\Imagen;


use App\Comentario;
use App\DAO\ComentarioDao;
use App\DAO\ImagenDao;
use App\Http\Controllers\Controller;
use App\Album;
use App\Imagen;
use Illuminate\Http\Request;

class ImagenController extends Controller
{
    /**
     * @var ImagenDao
     */
    protected $comentarioDao;

    /**
     * @var
     */
    protected $comentario;

    function __construct()
    {
        $this->comentarioDao = new ComentarioDao();
    }

    public function guardar(Request $request){
        $this->comentario = new Comentario($request);
        $imagen_valida = $this->comentario->validar();
        if($imagen_valida === TRUE){
            $this->comentarioDao->insertar($this->comentario);
            return response()->json(['codigo' => '0', 'mensaje' => 'Comentario guardado exitosamente']);
        } else {
            return response()->json($imagen_valida);
        }
    }

    public function consultar(Request $request){
        $this->albumImagen = new Album($request);
        $albumes = $this->imagenDao->consultar($this->albumImagen->getIdAlbum());
        return response()->json(['codigo' => '0',"resultado"=>$albumes]);
    }

}