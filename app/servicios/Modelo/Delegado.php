<?php

namespace Modelo;
class Delegado extends Persona{
    public $idDelegado;
    public $email;
    
    function __construct($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta, $email) {
        parent::__construct($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta);
        $this->email = $email;
    }
    
    function getIdDelegado() {
        return $this->idDelegado;
    }

    function getEmail() {
        return $this->email;
    }
    
    
    function setIdDelegado($idDelegado) {
        $this->idDelegado = $idDelegado;
    }

    function setEmail($email) {
        $this->email = $email;
    }



}
