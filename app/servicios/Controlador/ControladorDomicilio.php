<?php

require_once '..\..\..\Modelo\Domicilio.php';

class ControladorDomicilio {
    //put your code here
    function __construct() {
        
    }
    
    public function insertarDomicilio($direccion, $cp, $telefono, $localidad, $provincia){
        if (!ServidorControladores::getConBD()->getConexion()->query("insert into domicilio values(null,'$direccion','
                $cp','$telefono','$localidad',' $provincia')")){
            die ("Error en la query de Controlador Domicilio");
        }
    }
    
    public function traerUltimoId(){
        $r=ServidorControladores::getConBD()->getConexion()->query("SELECT MAX(idDomicilio) AS id FROM domicilio" )->fetch_array();
        
        return $r['id'];    
    }
    
    public function traerDomicilioXID($id){
        $r=  ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM domicilio WHERE idDomicilio='$id'")->fetch_array();
        $d= new \Modelo\Domicilio($r['direccion'], $r['cp'], $r['telefono'], $r['localidad'], $r['provincia']);
        $d->setIdDomicilio($r['idDomicilio']);
        return $d;
    }
    
    public function actualizarDomicilio(Domicilio $dom){
        try{
            ServidorControladores::getConBD()->getConexion()->query("START TRANSACTION");
            ServidorControladores::getConBD()->getConexion()->query("UPDATE Domicilio direccion=".$dom->getDireccion()." cp=". $dom->getCp().
                " telefono=". $dom->getTelefono(). " localidad=". $dom->getLocalidad(). " provincia=".$dom->getProvincia().
                " WHERE idDomicilio=".$dom->getIdDomicilio());
            ServidorControladores::getConBD()->getConexion()->query("COMMIT");
        } catch(mysqli_sql_exception $ex){
            ServidorControladores::getConBD()->getConexion()->query("ROLLBACK");
            echo 'Error: '. $ex->getMessage();
        }
    }
}
