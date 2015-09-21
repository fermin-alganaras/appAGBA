<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Delegado
 *
 * @author JuanPAblo
 */
class Delegado extends Persona{
    private $idDelegado;
    private $email;
    
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
