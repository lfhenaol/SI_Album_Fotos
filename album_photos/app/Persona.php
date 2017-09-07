<?php

namespace App;

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
                $this->tipo = isset($value->tipo) ? $value->tipo: null;
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


}
