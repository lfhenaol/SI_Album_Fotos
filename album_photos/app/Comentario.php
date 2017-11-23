<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 13/11/2017
 * Time: 09:55 PM
 */

namespace App;


use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class Comentario
{

    /**
     * @var
     */
    private $id;

    /**
     * @var null
     */
    private $comentario;

    /**
     * @var
     */
    private $fecha_publicacion;

    /**
     * @var
     */
    private $id_imagen;

    /**
     * @var
     */
    private $id_usuario;

    function __construct($value = null)
    {
        if($value != null){
            if(is_array($value)){
                settype($value, 'object');
            }

            if(is_object($value)){
                $this->id = isset($value->id_album) ? $value->id_album: null;
                $this->comentario = isset($value->comentario) ? $value->comentario: null;
                $this->fecha_publicacion = date("Y-m-d H:i:s");
                $this->id_imagen = isset($value->id_imagen) ? $value->id_imagen: null;
                $this->id_usuario = isset($value->id_usuario) ? $value->id_usuario: null;
            }
        }
    }

    public function validar(){
        $mensajes = array(
            'comentario.required'  => 'El campo es requerido',
            'comentario.max'       => 'El campo debe contener máximo 300 caracteres'
        );

        $reglas = array(
            'comentario'   =>  'required|max:300',
        );

        $form_validado = Validator::make(Request::all(), $reglas, $mensajes);

        if($form_validado->fails()){
            return [
                'codigo'=>'100',
                'mensaje' => 'Los campos del formulario contienen errores',
                'errores' => $form_validado->errors()
            ];
        }

        return TRUE;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * @param null $comentario
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    /**
     * @return mixed
     */
    public function getFechaPublicacion()
    {
        return $this->fecha_publicacion;
    }

    /**
     * @param mixed $fecha_publicacion
     */
    public function setFechaPublicacion($fecha_publicacion)
    {
        $this->fecha_publicacion = $fecha_publicacion;
    }

    /**
     * @return mixed
     */
    public function getIdImagen()
    {
        return $this->id_imagen;
    }

    /**
     * @param mixed $id_imagen
     */
    public function setIdImagen($id_imagen)
    {
        $this->id_imagen = $id_imagen;
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @param mixed $id_usuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

}