<?php

namespace Modelo;
class Dirigente extends Persona{
    public $idDirigente;
    public $cargo;
    public $email;
    function __construct($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad,$exportada, 
            $fechaAlta, $cargo, $email, $idClub) {
        parent::__construct($apellido, $nombre, $dni, $fNacimiento, $sexo, $nacionalidad, $exportada, $fechaAlta, $idClub);
        $this->cargo = $cargo;
        $this->email= $email;
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
