<?php

require_once 'ControladorAlta.php';
require_once 'ControladorBaseDeDatos.php';
require_once 'ControladorCategoria.php';
require_once 'ControladorClub.php';
require_once 'ControladorDelegado.php';
require_once 'ControladorDirigente.php';
require_once 'ControladorDomicilio.php';
require_once 'ControladorJuez.php';
require_once 'ControladorLicencia.php';
require_once 'ControladorNotificacion.php';
require_once 'ControladorPatinador.php';
require_once 'ControladorTecnico.php';
require_once 'ControladorUsuario.php';
require_once 'ControladorListaBnaFe.php';
require_once 'ControladorCompetencias.php';
require_once 'ControladorTorneo.php';
require_once 'ControladorReportes.php';


class ServidorControladores {
    
    static private $cAlta=null;
    static private $cBaseDatos=null;
    static private $cCategoria=null;
    static private $cClub= null;
    static private $cDelegado= null;
    static private $cDirigente= null;
    static private $cDomicilio= null;
    static private $cJuez=null;
    static private $cLicencia= null;
    static private $cNotificacion= null;
    static private $cPatinador=null;
    static private $cTecnico=null;
    static private $cUsuario=null;
    static private $cListaBnaFe=null;
    static private $cCompetencias=null;
    static private $cTorneo=null;
    static private $cReportes= null;
            
    function __construct() {
        
    }
    
    static function getConAlta(){
        if (static::$cAlta==null) {
            static::$cAlta= new ControladorAlta();
            return static::$cAlta;
        }  else {
            return static::$cAlta;
        }
    }
    
    static function getConBD(){
        if (static::$cBaseDatos==null) {
            static::$cBaseDatos= new ControladorBaseDeDatos();
            return static::$cBaseDatos;
        }  else {
            return static::$cBaseDatos;
        }
    }
    
    static function getConCategoria(){
        if (static::$cCategoria==null) {
            static::$cCategoria= new ControladorCategoria();
            return static::$cCategoria;
        }  else {
            return static::$cCategoria;
        }
    }
    
    static function getConClub(){
        if (static::$cClub==null) {
            static::$cClub= new ControladorClub();
            return static::$cClub;
        }  else {
            return static::$cClub;
        }
    }
    
    static function getConDelegado(){
        if (static::$cDelegado==null) {
            static::$cDelegado= new ControladorDelegado();
            return static::$cDelegado;
        }  else {
            return static::$cDelegado;
        }
    }
    
    static function getConDirigente(){
        if (static::$cDirigente==null) {
            static::$cDirigente= new ControladorDirigente();
            return static::$cDirigente;
        }  else {
            return static::$cDirigente;
        }
    }
    
    static function getConDomicilio(){
        if (static::$cDomicilio==null) {
            static::$cDomicilio= new ControladorDomicilio();
            return static::$cDomicilio;
        }  else {
            return static::$cDomicilio;
        }
    }
    
    static function getConJuez(){
        if (static::$cJuez==null) {
            static::$cJuez= new ControladorJuez();
            return static::$cJuez;
        }  else {
            return static::$cJuez;
        }
    }
    
    static function getConLicencia(){
        if (static::$cLicencia==null) {
            static::$cLicencia= new ControladorLicencia();
            return static::$cLicencia;
        }  else {
            return static::$cLicencia;
        }
    }
    
    static function getConNotificacion(){
        if (static::$cNotificacion==null) {
            static::$cNotificacion= new ControladorNotificacion();
            return static::$cNotificacion;
        }  else {
            return static::$cNotificacion;
        }
    }
    
    static function getConPatinador(){
        if (static::$cPatinador==null) {
            static::$cPatinador= new ControladorPatinador();
            return static::$cPatinador;
        }  else {
            return static::$cPatinador;
        }
    }
    
    static function getConTecnico(){
        if (static::$cTecnico==null) {
            static::$cTecnico= new ControladorTecnico();
            return static::$cTecnico;
        }  else {
            return static::$cTecnico;
        }
    }
    
    static function getConUsuario(){
        if (static::$cUsuario==null) {
            static::$cUsuario= new ControladorUsuario();
            return static::$cUsuario;
        }  else {
            return static::$cUsuario;
        }
    }
    
    static function invertirFecha($fecha){
        $aF= explode('-', $fecha);
        $aux= $aF[0];
        $aF[0]= $aF[2];
        $aF[2]= $aux;
        $nF= implode('-', $aF);
        return $nF;
    }
    
    static function getConListaBnaFe(){
        if (static::$cListaBnaFe==null) {
            static::$cListaBnaFe= new ControladorListaBnaFe();
            return static::$cListaBnaFe;
        }  else {
            return static::$cListaBnaFe;
        }
    }
    
    static function getConCompetencias(){
        if (static::$cCompetencias==null) {
            static::$cCompetencias= new ControladorCompetencias();
            return static::$cCompetencias;
        }  else {
            return static::$cCompetencias;
        }
    }
    
    static function getConTorneo(){
        if (static::$cTorneo==null) {
            static::$cTorneo= new ControladorTorneo();
            return static::$cTorneo;
        }  else {
            return static::$cTorneo;
        }
    }
    
    static function getConReportes(){
        if (static::$cReportes==null) {
            static::$cReportes= new ControladorReportes();
            return static::$cReportes;
        }  else {
            return static::$cReportes;
        }
    }
    

}
