<?php

namespace Modelo;
class Usuario {
    
    public $idUsuario;
    public $user;
    public $pass;
    public $tipo;
    public $estado;
    public $club;
    public $ultimaSesion;
    
    function __construct($user, $pass, $tipo, $estado, $ultimaSesion) {
        $this->user = $user;
        $this->pass = $pass;
        $this->tipo = $tipo;
        $this->estado= $estado;
        $this->ultimaSesion= $ultimaSesion;
    }



    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getUser() {
        return $this->user;
    }

    function getPass() {
        return $this->pass;
    }

    function getSuper() {
        return $this->super;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    function setSuper($super) {
        $this->super = $super;
    }

    function getClub() {
        return $this->club;
    }

    function setClub($club) {
        $this->club = $club;
    }
    
    function getTipo() {
        return $this->tipo;
    }

    function getEstado() {
        return $this->estado;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
    
    function getUltimaSesion() {
        return $this->ultimaSesion;
    }

    function setUltimaSesion($ultimaSesion) {
        $this->ultimaSesion = $ultimaSesion;
    }








}
