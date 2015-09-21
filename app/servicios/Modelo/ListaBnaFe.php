<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ListaBnaFe
 *
 * @author JuanPAblo
 */
class ListaBnaFe {
    private $idListaBnaFe;
    private $fechaCreacion;
    private $refArchivo;
    private $club;
    private $torneo;
    
    
    function __construct($fechaCreacion, $refArchivo) {
        $this->fechaCreacion = $fechaCreacion;
        $this->refArchivo = $refArchivo;
    }
    
    function getIdListaBnaFe() {
        return $this->idListaBnaFe;
    }

    function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    function getRefArchivo() {
        return $this->refArchivo;
    }

    function setIdListaBnaFe($idListaBnaFe) {
        $this->idListaBnaFe = $idListaBnaFe;
    }

    function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;
    }

    function setRefArchivo($refArchivo) {
        $this->refArchivo = $refArchivo;
    }

    function getClub() {
        return $this->club;
    }

    function setClub($club) {
        $this->club = $club;
    }
    
    function getTorneo() {
        return $this->torneo;
    }

    function setTorneo($torneo) {
        $this->torneo = $torneo;
    }





}
