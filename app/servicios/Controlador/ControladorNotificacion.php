<?php

require_once ('ControladorAlta.php');
require_once '..\..\..\Modelo\Notificacion.php';
class ControladorNotificacion {
   
    
    function __construct() {
       
    }
    
    public function nuevaNotifAlta($idAlta, $idUser){
        try {
            $idAdmin= $this->traerIdAdmin();
            $fecha= date(DATE_W3C);
            $texto='El club '. ServidorControladores::getConUsuario()->traerUsuarioXID($idUser)->getClub()->getNombre() .' solicita alta de patinadores, tecnicos y/ delegados.';
            if (!ServidorControladores::getConBD()->getConexion()->query("INSERT INTO notificacion "
                    . "VALUES('null', 'alta', '$texto','$idUser','$idAdmin','$fecha','$idAlta')")) {
                die(ServidorControladores::getConBD()->getConexion()->error . ' En la misma sentencia');
            }
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function nuevaNotifAperTor($idTorneo){
         try {
            $idAdmin= $this->traerIdAdmin();
            $idUser=0;
            $torneo=  ServidorControladores::getConTorneo()->traerTorneoXID($idTorneo);
            $texto= 'Las inscripciones para ' + $torneo->getDenominacion() + ' ya estan abiertas. Ya puede enviar la lista de buena fe';
            $fecha= date(DATE_W3C);
            if (!ServidorControladores::getConBD()->getConexion()->query("INSERT INTO notificacion VALUES(null, 'nvoTorneo', '$texto','$idAdmin','$idUser','$fecha','$idTorneo')")) {
                die(ServidorControladores::getConBD()->getConexion()->error . ' En la misma sentencia');
            }
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function nuevaNotifCerrTor($idTorneo){
         try {
            $idAdmin= $this->traerIdAdmin();
            $idUser=0;
            $torneo=  ServidorControladores::getConTorneo()->traerTorneoXID($idTorneo);
            $texto= 'Las inscripciones para ' + $torneo->getDenominacion() + ' han concluido. Ya puede descargar el listado de competencias.';
            $fecha= date(DATE_W3C);
            if (!ServidorControladores::getConBD()->getConexion()->query("INSERT INTO notificacion VALUES(null, 'msj', '$texto','$idAdmin','$idUser','$fecha','$idTorneo')")) {
                die(ServidorControladores::getConBD()->getConexion()->error . ' En la misma sentencia');
            }
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }
    public function nuevaNotifAceptAlta($alta){
        try {
            $idAdmin= $this->traerIdAdmin();
            $idUser=$alta->getUser()->getIdUsuario();
            $idAlta=$alta->getIdAlta();
            $fecha= date(DATE_W3C);
            if (!ServidorControladores::getConBD()->getConexion()->query("INSERT INTO notificacion VALUES(null, 'aceptAlta', 'Solicitud de alta de patinadores ha sido procesada','$idAdmin','$idUser','$fecha','$idAlta')")) {
                die(ServidorControladores::getConBD()->getConexion()->error . ' En la misma sentencia');
            }
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function traerIdAdmin(){
        try {
            
            if(!$r= ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM usuario WHERE tipo='admin'")){
                die (ServidorControladores::getConBD()->getConexion()->error);
            }
            while ($f=$r->fetch_array()){    
                $id=$f['idUsuario'];
            }
            return $id;
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function traerNotifUser($id){
        $notificaciones=array();
        $fecha= ServidorControladores::getConUsuario()->traerUsuarioXID($id)->getUltimaSesion();
        if (!$r=ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM notificacion WHERE idReceptor='$id' AND fecha>'$fecha' ORDER BY fecha DESC")) {
            die(ServidorControladores::getConBD()->getConexion()->error);
        }
        
        while($n= $r->fetch_array()){
            $notif= new Modelo\Notificacion($n['tipo'], $n['texto'], $n['idEmisor'], $n['idReceptor'], $n['fecha'], $n['idElemento'] );
            $notif->setIdNotificacion($n['idNotificacion']);
            $notif->setIdElemento($n['idElemento']);
            array_push($notificaciones, $notif);
        }
        
        return $notificaciones;
    }
}
