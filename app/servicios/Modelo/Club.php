<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Club
 *
 * @author JuanPAblo
 */
class Club {
    
    private $idClub;
    private $nombre;
    private $presidente;
    private $secretario;
    private $usuario;
    
    function __construct($nombre) {
        $this->nombre = $nombre;
    }
    
    function getIdClub() {
        return $this->idClub;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPresidente() {
        return $this->presidente;
    }

    function getSecretario() {
        return $this->secretario;
    }

    function setIdClub($idClub) {
        $this->idClub = $idClub;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setPresidente($presidente) {
        $this->presidente = $presidente;
    }

    function setSecretario($secretario) {
        $this->secretario = $secretario;
    }


    function getUsuario() {
        return $this->usuario;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }


}
