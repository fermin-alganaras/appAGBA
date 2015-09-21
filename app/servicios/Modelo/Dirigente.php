<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dirigente
 *
 * @author JuanPAblo
 */
class Dirigente extends Persona{
    private $idDirigente;
    private $cargo;
    
    function __construct($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad,$exportada, $fechaAlta, $cargo) {
        parent::__construct($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta);
        $this->cargo = $cargo;
    }
    
    function getIdDirigente() {
        return $this->idDirigente;
    }

    function getCargo() {
        return $this->cargo;
    }

    function setIdDirigente($idDirigente) {
        $this->idDirigente = $idDirigente;
    }

    function setCargo($cargo) {
        $this->cargo = $cargo;
    }



}
