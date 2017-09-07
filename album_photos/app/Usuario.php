<?php

namespace App;

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
     * @return boolean
     */
    function validar(){

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
