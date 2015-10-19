<?php


namespace Modelo;


class Notificacion {
    
    public $idNotificacion;
    public $tipo;
    public $texto;
    public $idEmisor;
    public $idReceptor;
    public $fecha;
    
    function __construct($tipo, $texto, $idEmisor, $idReceptor, $fecha) {
        $this->tipo = $tipo;
        $this->texto = $texto;
        $this->idEmisor = $idEmisor;
        $this->idReceptor = $idReceptor;
        $this->fecha = $fecha;
    }
    
    function getIdNotificacion() {
        return $this->idNotificacion;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getTexto() {
        return $this->texto;
    }

    function getIdEmisor() {
        return $this->idEmisor;
    }

    function getIdReceptor() {
        return $this->idReceptor;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setIdNotificacion($idNotificacion) {
        $this->idNotificacion = $idNotificacion;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    function setIdEmisor($idEmisor) {
        $this->idEmisor = $idEmisor;
    }

    function setIdReceptor($idReceptor) {
        $this->idReceptor = $idReceptor;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }



}
