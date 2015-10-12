<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author JuanPAblo
 */
class Usuario {

    private $idUsuario;
    private $user;
    private $pass;
    private $super;
    private $club;

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
