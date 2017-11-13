<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 06/11/2017
 * Time: 08:27 PM
 */

namespace App;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class Album
{
    /**
     * @var null
     */
    private $id_album;

    /**
     * @var null
     */
    private $nombre;

    /**
     * @var null
     */
    private $descripcion;

    /**
     * @var null
     */
    private $privacidad;

    /**
     * @var null
     */
    private $id_usuario;

    /**
     * @var
     */
    private $fecha_creacion;

    /**
     * @var
     */
    private $imagen;

    function __construct($value = null)
    {
        if($value != null){
            if(is_array($value)){
                settype($value, 'object');
            }

            if(is_object($value)){
                $this->id_album = isset($value->id_album) ? $value->id_album: null;
                $this->nombre = isset($value->nombre) ? $value->nombre: null;
                $this->descripcion = isset($value->descripcion) ? $value->descripcion: null;
                $this->privacidad = isset($value->privacidad) ? $value->privacidad: null;
                $this->id_usuario = isset($value->id_usuario) ? $value->id_usuario: null;
                $this->fecha_creacion = date("Y-m-d H:i:s");
                $this->imagen = new Imagen($value);
            }
        }
    }

    /**
     * @return array|bool
     */
    public function validar(){
        $mensajes = array(
            'nombre.required'       => 'El campo nombre es requerido',
            'nombre.max'            => 'El campo debe contener máximo 100 caracteres',
            'descripcion.required'  => 'El campo descripción es requerido',
            'descripcion.max'       => 'El campo debe contener máximo 300 caracteres',
            'privacidad.required'   => 'El campo privacidad es requerido',
            'privacidad.digits'     => 'El campo privacidad es numerico y de un solo dígito'
        );

        $reglas = array(
            'nombre'        =>  'required|max:100',
            'descripcion'   =>  'required|max:300',
            'privacidad'    =>  'required|digits:1'
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
    public function getIdAlbum()
    {
        return $this->id_album;
    }

    /**
     * @param mixed $id
     */
    public function setIdAlbum($id)
    {
        $this->id_album = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getPrivacidad()
    {
        return $this->privacidad;
    }

    /**
     * @param mixed $privacidad
     */
    public function setPrivacidad($privacidad)
    {
        $this->privacidad = $privacidad;
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

    /**
     * @return mixed
     */
    public function getFechaCreacion()
    {
        return $this->fecha_creacion;
    }

    /**
     * @param mixed $fecha_creacion
     */
    public function setFechaCreacion($fecha_creacion)
    {
        $this->fecha_creacion = $fecha_creacion;
    }

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }



}