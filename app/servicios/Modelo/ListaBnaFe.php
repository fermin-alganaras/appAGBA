<?php

namespace Modelo;

class ListaBnaFe {

    public $idListaBnaFe;
    public $fechaCreacion;
    public $club;
    public $torneo;
    public $infoLista;

    public function __construct($fechaCreacion, $idTorneo, $idClub) {
        $this->fechaCreacion = $fechaCreacion;
        $this->torneo = $idTorneo;
        $this->club = $idClub;
        $this->infoLista = array();
    }

    public function getIdListaBnaFe() {
        return $this->idListaBnaFe;
    }

    public function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    public function setIdListaBnaFe($idListaBnaFe) {
        $this->idListaBnaFe = $idListaBnaFe;
    }

    public function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;
    }

    public function getClub() {
        return $this->club;
    }

    public function setClub($club) {
        $this->club = $club;
    }

    public function getTorneo() {
        return $this->torneo;
    }

    public function setTorneo($torneo) {
        $this->torneo = $torneo;
    }

    public function getInfoLista() {
        return $this->infoLista;
    }

    public function setInfoLista($infoLista) {
        $this->infoLista = $infoLista;
    }

}

class ItemListaSolista {

    public $idPatinador;
    public $idCategoria;
    public $esc;
    public $libr;
    public $solo;
    public $free;

    function __construct($idPat, $idCategoria, $esc, $libr, $solo, $free) {
        $this->idPatinador = $idPat;
        $this->idCategoria = $idCategoria;
        $this->esc = $esc;
        $this->libr = $libr;
        $this->solo = $solo;
        $this->free = $free;
    }

    function getIdPatinador() {
        return $this->idPatinador;
    }

    function getEsc() {
        return $this->esc;
    }

    function getLibr() {
        return $this->libr;
    }

    function getSolo() {
        return $this->solo;
    }

    function getFree() {
        return $this->free;
    }

    function setIdPatinador($idPatinador) {
        $this->idPatinador = $idPatinador;
    }

    function setEsc($esc) {
        $this->esc = $esc;
    }

    function setLibr($libr) {
        $this->libr = $libr;
    }

    function setSolo($solo) {
        $this->solo = $solo;
    }

    function setFree($free) {
        $this->free = $free;
    }

    function getIdCategoria() {
        return $this->idCategoria;
    }

    function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

}

class ItemListaPareja {

    public $idPatCab;
    public $idPatDam;
    public $idCategoria;
    public $libre;
    public $solo;
    public $free;

    function __construct($idPatCab, $idPatDam, $idCategoria, $libre, $solo, $free) {
        $this->idPatCab = $idPatCab;
        $this->idPatDam = $idPatDam;
        $this->idCategoria = $idCategoria;
        $this->libre = $libre;
        $this->solo = $solo;
        $this->free = $free;
    }

    function getIdPatCab() {
        return $this->idPatCab;
    }

    function getIdPatDam() {
        return $this->idPatDam;
    }

    function getLibre() {
        return $this->libre;
    }

    function getSolo() {
        return $this->solo;
    }

    function getFree() {
        return $this->free;
    }

    function setIdPatCab($idPatCab) {
        $this->idPatCab = $idPatCab;
    }

    function setIdPatDam($idPatDam) {
        $this->idPatDam = $idPatDam;
    }

   function setLibre($libr) {
        $this->libre = $libr;
    }

    function setSolo($solo) {
        $this->solo = $solo;
    }

    function setFree($free) {
        $this->free = $free;
    }

    function getIdCategoria() {
        return $this->idCategoria;
    }

    function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

}

class ItemListaGrupal {

    public $nombreGrupal;
    public $idsPatinadores;
    public $idCategoria;

    function __construct($nombreGrupal, $idsPatinadores, $idCategoria) {
        $this->nombreGrupal = $nombreGrupal;
        $this->idsPatinadores = $idsPatinadores;
        $this->idCategoria = $idCategoria;
    }

    function getNombreGrupal() {
        return $this->nombreGrupal;
    }

    function getIdsPatinadores() {
        return $this->idsPatinadores;
    }

    function getIdCategoria() {
        return $this->idCategoria;
    }

    function setNombreGrupal($nombreGrupal) {
        $this->nombreGrupal = $nombreGrupal;
    }

    function setIdsPatinadores($idsPatinadores) {
        $this->idsPatinadores = $idsPatinadores;
    }

    function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

}

class ItemListaTecDel {

    public $idTecDel;
    public $tipo;

    function __construct($idTecDel, $tipo) {
        $this->idTecDel = $idTecDel;
        $this->tipo = $tipo;
    }

    function getIdTecDel() {
        return $this->idTecDel;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setIdTecDel($idTecDel) {
        $this->idTecDel = $idTecDel;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

}
