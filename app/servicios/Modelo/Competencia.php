<?php

namespace Modelo;
class Competencia {
    
    
    public $denominacion;
    public $edad;
    public $idCat;
    public $sexo;
    public $competidores;
    public $tipo;
    
    
    function __construct($denominacion, $edad, $idCat, $sexo, $tipo) {
        $this->denominacion = $denominacion;
        $this->edad = $edad;
        $this->idCat = $idCat;
        $this->sexo = $sexo;
        $this->competidores= array();
        $this->tipo=$tipo;
    }
    
    function getDenominacion() {
        return $this->denominacion;
    }

    function getEdad() {
        return $this->edad;
    }

    function getIdCat() {
        return $this->idCat;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getCompetidores() {
        return $this->competidores;
    }

    function setDenominacion($denominacion) {
        $this->denominacion = $denominacion;
    }

    function setEdad($edad) {
        $this->edad = $edad;
    }

    function setIdCat($idCat) {
        $this->idCat = $idCat;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setCompetidores($competidores) {
        $this->competidores = $competidores;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }



}

class CompetidorSolista{
    
    public $idPat;
    public $esc;
    public $libr;
    public $sd;
    public $fd;
    public $rEsc;
    public $rLibr;
    public $rSd;
    public $rFd;
    public $tipo;
    
    function __construct($idPat, $esc, $libr, $sd, $fd) {
        $this->idPat = $idPat;
        $this->esc = $esc;
        $this->libr = $libr;
        $this->sd = $sd;
        $this->fd = $fd;
        $this->tipo=1;
    }
    
    function getIdPat() {
        return $this->idPat;
    }

    function getEsc() {
        return $this->esc;
    }

    function getLibr() {
        return $this->libr;
    }

    function getSd() {
        return $this->sd;
    }

    function getFd() {
        return $this->fd;
    }

    function getREsc() {
        return $this->rEsc;
    }

    function getRLibr() {
        return $this->rLibr;
    }

    function getRSd() {
        return $this->rSd;
    }

    function getRFd() {
        return $this->rFd;
    }

    function setIdPat($idPat) {
        $this->idPat = $idPat;
    }

    function setEsc($esc) {
        $this->esc = $esc;
    }

    function setLibr($libr) {
        $this->libr = $libr;
    }

    function setSd($sd) {
        $this->sd = $sd;
    }

    function setFd($fd) {
        $this->fd = $fd;
    }

    function setREsc($rEsc) {
        $this->rEsc = $rEsc;
    }

    function setRLibr($rLibr) {
        $this->rLibr = $rLibr;
    }

    function setRSd($rSd) {
        $this->rSd = $rSd;
    }

    function setRFd($rFd) {
        $this->rFd = $rFd;
    }

    function getTipo() {
        return $this->tipo;
    }




}

class CompetidorPareja{
    
    public $idDama;
    public $idCab;
    public $libr;
    public $sd;
    public $fd;
    public $rLibr;
    public $rSd;
    public $rFd;
    public $tipo;
    
    function __construct($idDama, $idCab, $libr, $sd, $fd) {
        $this->idDama = $idDama;
        $this->idCab= $idCab;
        $this->libr = $libr;
        $this->sd = $sd;
        $this->fd = $fd;
        $this->tipo=2;
    }
    
    

    function getLibr() {
        return $this->libr;
    }

    function getSd() {
        return $this->sd;
    }

    function getFd() {
        return $this->fd;
    }

    

    function getRLibr() {
        return $this->rLibr;
    }

    function getRSd() {
        return $this->rSd;
    }

    function getRFd() {
        return $this->rFd;
    }

    function setLibr($libr) {
        $this->libr = $libr;
    }

    function setSd($sd) {
        $this->sd = $sd;
    }

    function setFd($fd) {
        $this->fd = $fd;
    }

    function setRLibr($rLibr) {
        $this->rLibr = $rLibr;
    }

    function setRSd($rSd) {
        $this->rSd = $rSd;
    }

    function setRFd($rFd) {
        $this->rFd = $rFd;
    }

    function getIdDama() {
        return $this->idDama;
    }

    function getIdCab() {
        return $this->idCab;
    }

    function setIdDama($idDama) {
        $this->idDama = $idDama;
    }

    function setIdCab($idCab) {
        $this->idCab = $idCab;
    }
    
    function getTipo() {
        return $this->tipo;
    }





}

class CompetidorGrupal{
    
    public $idPat;
    public $libr;
    public $rLibr;
    public $tipo;
    
    function __construct($idPat, $libr) {
        $this->idPat = $idPat;
        $this->libr = $libr;
        $this->tipo=3;
        
    }
    
    function getIdPat() {
        return $this->idPat;
    }

    function getLibr() {
        return $this->libr;
    }

    function getRLibr() {
        return $this->rLibr;
    }

    

    function setIdPat($idPat) {
        $this->idPat = $idPat;
    }

   
    function setLibr($libr) {
        $this->libr = $libr;
    }

    function setRLibr($rLibr) {
        $this->rLibr = $rLibr;
    }
    
    function getTipo() {
        return $this->tipo;
    }


} 