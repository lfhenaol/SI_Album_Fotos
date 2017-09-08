<?php

namespace App;

use App\DAO\UsuarioDao;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class Persona
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $nombre;

    /**
     * @var
     */
    private $avatar;

    /**
     * @var
     */
    private $tipo;

    /**
     * @var
     */
    private $usuario;

    /**
     * Persona constructor.
     */
    function __construct($value = null)
    {
        if($value != null){
            if(is_array($value)){
                settype($value, 'object');
            }

            if(is_object($value)){
                $this->id = isset($value->id) ? $value->id: null;
                $this->nombre = isset($value->nombre) ? $value->nombre: null;
                $this->avatar = isset($value->avatar) ? $value->avatar: null;
                $this->tipo = isset($value->tipo) ? $value->tipo: "Usuario";
                $this->usuario = new Usuario($value);
            }
        }
    }

    /**
     * @name validar
     * @return mixed
     */
    function validar(){
        $mensajes = array(
            'nombre.required'       => 'El campo nombre es requerido',
            'nombre.size'           => 'El campo debe contener máximo 100 caracteres',
            'avatar.required'       => 'El campo avatar es requerido',
            'nickname.required'     => 'El campo nombre de usuario es requerido',
            'nickname.size'         => 'El campo nombre de usuario debe contener máximo 50 caracteres',
            'contrasenia.required'  => 'El campo contrasenia es requerido',
            'contrasenia.size'      => 'El campo contraseñia debe contener máximo 200 caracteres'
        );

        $reglas = array(
            'nombre'        =>  'required|size:100',
            'avatar'        =>  'required',
            'nickname'      =>  'required|size:50',
            'contrasenia'   =>  'required|size:200'
        );

        $form_validado = Validator::make(Request::all(), $reglas, $mensajes);

        if($form_validado->fails()){
            return [
                'codigo'=>'100',
                'mensaje' => 'Los campos del formulario contienen errores',
                'errores' => $form_validado->errors()
            ];
        }

        // Valida que no se ingrese un nombre de usuario ya existente
        $usuarioDao = new UsuarioDao();
        if($usuarioDao->consultar($this->getUsuario()->getNickname())->count() > 0){
            return [
                'codigo' => '101',
                'mensaje' => 'El nombre de usuario ingresado ya existe'
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
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }


}
