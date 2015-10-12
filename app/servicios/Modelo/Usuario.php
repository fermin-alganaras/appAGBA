<?php

namespace Modelo;
class Usuario {
    
    public $idUsuario;
    public $user;
    public $pass;
    public $super;
    public $club;
    
    function __construct($user, $pass, $super) {
        $this->user = $user;
        $this->pass = $pass;
        $this->super = $super;
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





}
