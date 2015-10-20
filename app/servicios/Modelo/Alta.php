<?php

namespace Modelo;
class Alta {
    
    public $idAlta;
    public $fecha;
    public $patinadores;
    public $delegados;
    public $tecnicos;
    public $user;
    public $atendida;
    
    function __construct($fecha, $atendida) {
        $this->fecha = $fecha;
        $this->atendida = $atendida;
    }
    
    function getIdAlta() {
        return $this->idAlta;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getPatinadores() {
        return $this->patinadores;
    }

    function getUser() {
        return $this->user;
    }

    function getAtendida() {
        return $this->atendida;
    }

    function setIdAlta($idAlta) {
        $this->idAlta = $idAlta;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setPatinadores($patinadores) {
        $this->patinadores = $patinadores;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setAtendida($atendida) {
        $this->atendida = $atendida;
    }
    
    function getDelegados() {
        return $this->delegados;
    }

    function getTecnicos() {
        return $this->tecnicos;
    }

    function setDelegados($delegados) {
        $this->delegados = $delegados;
    }

    function setTecnicos($tecnicos) {
        $this->tecnicos = $tecnicos;
    }





}
