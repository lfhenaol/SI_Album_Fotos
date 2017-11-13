<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 12/11/2017
 * Time: 10:25 AM
 */

namespace App;


use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class Imagen
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $foto;

    /**
     * @var string
     */
    private $titulo;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \DateTime
     */
    private $fecha_creacion;

    /**
     * @var string
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
                $this->foto = isset($value->foto) ? $value->foto: null;
                $this->titulo = isset($value->titulo) ? $value->titulo: null;
                $this->descripcion = isset($value->descripcion) ? $value->descripcion: null;
                $this->fecha_creacion = date("Y-m-d H:i:s");
                $this->id_usuario = isset($value->id_usuario) ? $value->id_usuario: null;
            }
        }
    }

    /**
     * @return array|bool
     */
    public function validar(){
        $mensajes = array(
            'foto.required'         => 'El campo foto es requerido',
            'foto.is_image'         => 'El campo foto no contiene un tipo de archivo imagen válido',
            'titulo.required'       => 'El campo titulo es requerido',
            'titulo.max'            => 'El campo titulo debe contener máximo 100 caracteres',
            'descripcion.required'  => 'El campo descripción es requerido',
            'descripcion.max'       => 'El campo debe contener máximo 300 caracteres'
        );

        $reglas = array(
            'foto'          =>  'required|is_image',
            'titulo'        =>  'required|max:100',
            'descripcion'   =>  'required|max:300',
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
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param mixed $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
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
     * @return \Datetime
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
     * @return string
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @param string $id_usuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }
}