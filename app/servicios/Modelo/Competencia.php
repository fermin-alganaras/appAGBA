<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Competencia
 *
 * @author JuanPAblo
 */
class Competencia {
    
    private $idCompetencia;
    private $denominacion;
    private $edad;
    private $archivo;
    
    function __construct($denominacion, $edad, $archivo) {
        $this->denominacion = $denominacion;
        $this->edad= $edad;
        $this->archivo= $archivo;
    }
    
    function getDenominacion() {
        return $this->denominacion;
    }

    function setDenominacion($denominacion) {
        $this->denominacion = $denominacion;
    }
    
    function getIdCompetencia() {
        return $this->idCompetencia;
    }

    function getEdad() {
        return $this->edad;
    }

    function getArchivo() {
        return $this->archivo;
    }

    function setIdCompetencia($idCompetencia) {
        $this->idCompetencia = $idCompetencia;
    }

    function setEdad($edad) {
        $this->edad = $edad;
    }

    function setArchivo($archivo) {
        $this->archivo = $archivo;
    }





}
