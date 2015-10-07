<?php

namespace Modelo;
class Dirigente extends Persona{
    public $idDirigente;
    public $cargo;
    
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
