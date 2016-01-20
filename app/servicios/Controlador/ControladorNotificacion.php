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
            if (!ServidorControladores::getConBD()->getConexion()->query("INSERT INTO notificacion "
                    . "VALUES('null', 'alta', 'Solicitud de alta de patinadores','$idUser','$idAdmin','$fecha','$idAlta')")) {
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
            if (!ServidorControladores::getConBD()->getConexion()->query("INSERT INTO notificacion "
                    . "VALUES('null', 'aceptAlta', 'Solicitud de alta de patinadores ha sido procesada','$idAdmin','$idUser','$fecha','$idAlta')")) {
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
        if (!$r=ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM notificacion WHERE idReceptor='$id' AND fecha>'$fecha' ORDER BY fecha")) {
            die(ServidorControladores::getConBD()->getConexion()->error);
        }
        
        while($n= $r->fetch_array()){
            $notif= new Modelo\Notificacion($n['tipo'], $n['texto'], $n['idEmisor'], $n['idReceptor'], $n['fecha'], $n['idElemento'] );
            array_push($notificaciones, $notif);
        }
        
        return $notificaciones;
    }
}
