<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 12/11/2017
 * Time: 01:41 PM
 */

namespace app\Http\Controllers\Album\Imagen;


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
    protected $imagenDao;

    /**
     * @var Album
     */
    protected $albumImagen;

    /**
     * @var
     */
    protected $imagen;

    function __construct()
    {
        $this->imagenDao = new ImagenDao();
    }

    public function guardar(Request $request){
        $this->albumImagen = new Album($request);

        $album_valido = $this->albumImagen->validar("imagen");
        if($album_valido === TRUE){
            $imagen_valida = $this->albumImagen->getImagen()->validar();
            if($imagen_valida === TRUE){
                $this->imagenDao->insertar($this->albumImagen);
                return response()->json(['codigo' => '0', 'mensaje' => 'Imagen guardada exitosamente']);
            } else {
                return response()->json($imagen_valida);
            }
        } else {
            return response()->json($album_valido);
        }

    }

    public function consultar(Request $request){
        $this->albumImagen = new Album($request);
        $albumes = $this->imagenDao->consultar($this->albumImagen->getIdAlbum());
        return response()->json(['codigo' => '0',"resultado"=>$albumes]);
    }

    public function modificar(Request $request){
        $this->imagen = new Imagen($request);
        $valido = $this->imagen->validar();
        if($valido == TRUE){
            $modificado = $this->imagenDao->actualizar($this->imagen);
            if($modificado === 1)
                return response()->json(['codigo' => '0', 'mensaje' => 'Imagen modificada exitosamente']);
            else
                return response()->json(['codigo'=>'120', 'mensaje'=>'No se encontró la imagen a modificar']);
        } else {
            return response()->json($valido);
        }
    }

}