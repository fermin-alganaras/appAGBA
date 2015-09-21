<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Torneo
 *
 * @author JuanPAblo
 */
class Torneo {
   
    private $idTorneo;
    private $denominacion;
    private $fInicio;
    private $fFin;
    private $refArchivo;
    private $listasBnaFe;
    private $competencias;
    
    function __construct($denominacion, $fInicio, $fFin) {
        $this->denominacion = $denominacion;
        $this->fInicio = $fInicio;
        $this->fFin = $fFin;
        $this->listasBnaFe= array();
        $this->competencias= array();
    }

    function getIdTorneo() {
        return $this->idTorneo;
    }

    function getDenominacion() {
        return $this->denominacion;
    }

    function getFInicio() {
        return $this->fInicio;
    }

    function getFFin() {
        return $this->fFin;
    }

    function getRefArchivo() {
        return $this->refArchivo;
    }

    function setIdTorneo($idTorneo) {
        $this->idTorneo = $idTorneo;
    }

    function setDenominacion($denominacion) {
        $this->denominacion = $denominacion;
    }

    function setFInicio($fInicio) {
        $this->fInicio = $fInicio;
    }

    function setFFin($fFin) {
        $this->fFin = $fFin;
    }

    function setRefArchivo($refArchivo) {
        $this->refArchivo = $refArchivo;
    }


    
}
