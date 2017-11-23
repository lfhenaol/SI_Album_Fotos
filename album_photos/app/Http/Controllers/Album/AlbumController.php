<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 07/11/2017
 * Time: 12:01 PM
 */

namespace app\Http\Controllers\Album;


use App\Album;
use App\DAO\AlbumDao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * @var AlbumDao
     */
    protected $albumDao;

    /**
     * @var
     */
    protected $album;

    function __construct()
    {
        $this->albumDao = new AlbumDao();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function crear(Request $request){
        $this->album = new Album($request);
        $album_valido = $this->album->validar("album");
        if($album_valido === TRUE){
            $this->albumDao->insertar($this->album);
            return response()->json(['codigo' => '0', 'mensaje' => 'Álbum creado exitosamente']);
        } else {
            return response()->json($album_valido);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function consultar(Request $request){
        $this->album = new Album($request);
        $albumes = $this->albumDao->consultar($this->album->getIdUsuario());
        return response()->json(['codigo' => '0',"resultado"=>$albumes]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listar(Request $request){
        $albumes = $this->albumDao->listar();
        return response()->json(['codigo' => '0',"resultado"=>$albumes]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function modificar(Request $request) {
        $this->album = new Album($request);
        $ok = $this->album->validar("album");
        if($ok === TRUE) {
            $this->albumDao->actualizar($this->album);
            return response()->json(['codigo' => '0', 'mensaje' => 'Álbum actualizado.']);
        } else {
            return response()->json($ok);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function eliminar(Request $request) {
        $this->album = new Album($request);
        $this->albumDao->borrar($this->album);
        return response()->json(['codigo' => '0', 'mensaje' => 'Álbum eliminado.']);
    }
}