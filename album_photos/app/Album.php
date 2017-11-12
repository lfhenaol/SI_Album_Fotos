<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 06/11/2017
 * Time: 08:27 PM
 */

namespace app;


use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class Album
{
    /**
     * @var null
     */
    private $id;

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

    function __construct($value = null)
    {
        if($value != null){
            if(is_array($value)){
                settype($value, 'object');
            }

            if(is_object($value)){
                $this->id = isset($value->id) ? $value->id: null;
                $this->nombre = isset($value->nombre) ? $value->nombre: null;
                $this->descripcion = isset($value->descripcion) ? $value->descripcion: null;
                $this->privacidad = isset($value->privacidad) ? $value->privacidad: null;
                $this->id_usuario = isset($value->id_usuario) ? $value->id_usuario: null;
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


}