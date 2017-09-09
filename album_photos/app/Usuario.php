<?php

namespace App;

use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

class Usuario
{
    /**
     * @var
     */
    private $id_persona;

    /**
     * @var
     */
    private $nickname;

    /**
     * @var
     */
    private $contrasenia;

    function __construct($value = null)
    {
        if($value != null){
            if(is_array($value)){
                settype($value, 'object');
            }

            if(is_object($value)){
                $this->nickname = isset($value->nickname) ? $value->nickname: null;
                $this->contrasenia = isset($value->contrasenia) ? $value->contrasenia: null;
                $this->id_persona = isset($value->id_persona) ? $value->id_persona: null;
            }
        }
    }

    /**
     * @name validar
     * @return array | bool
     */
    function validar(){
        $mensajes = array(
            'nickname.required'     => 'El campo nombre de usuario es requerido',
            'nickname.max'         => 'El campo nombre de usuario debe contener máximo 50 caracteres',
            'contrasenia.required'  => 'El campo contrasenia es requerido',
            'contrasenia.max'      => 'El campo contraseñia debe contener máximo 200 caracteres'
        );

        $reglas = array(
            'nickname'      =>  'required|max:50',
            'contrasenia'   =>  'required|max:200'
        );

        $campos = array(
            'nickname'      =>  $this->nickname,
            'contrasenia'   =>  $this->contrasenia
        );

        $form_validado = Validator::make($campos, $reglas, $mensajes);

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
    public function getIdPersona()
    {
        return $this->id_persona;
    }

    /**
     * @param mixed $id_persona
     */
    public function setIdPersona($id_persona)
    {
        $this->id_persona = $id_persona;
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param mixed $nickname
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    /**
     * @return mixed
     */
    public function getContrasenia()
    {
        return $this->contrasenia;
    }

    /**
     * @param mixed $contrasenia
     */
    public function setContrasenia($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    }


}
