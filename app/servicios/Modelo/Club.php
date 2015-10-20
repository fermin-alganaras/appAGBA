<?php

namespace Modelo;
class Club {
    
    public $idClub;
    public $nombre;
    public $domicilio;
    public $presidente;
    public $secretario;
    
    
    function __construct($nombre, $presidente, $secretario) {
        $this->nombre = $nombre;
        $this->presidente= $presidente;
        $this->secretario= $secretario;
    }
    
    function getIdClub() {
        return $this->idClub;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPresidente() {
        return $this->presidente;
    }

    function getSecretario() {
        return $this->secretario;
    }

    function setIdClub($idClub) {
        $this->idClub = $idClub;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setPresidente($presidente) {
        $this->presidente = $presidente;
    }

    function setSecretario($secretario) {
        $this->secretario = $secretario;
    }


    function getDomicilio() {
        return $this->domicilio;
    }

    function setDomicilio($domicilio) {
        $this->domicilio = $domicilio;
    }




}
