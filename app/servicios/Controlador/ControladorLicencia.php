<?php

require_once '..\..\..\Modelo\Licencia.php';
class ControladorLicencia extends ControladorGeneral{
    
    function __construct() {
        parent::__construct();
    }
    
    public function traerLicenciaXIdPersona($id){
        try {
            $rLic= static::$bd->getConexion()->query("SELECT * FROM licencia WHERE idPersona=".$id);
            while($rL=$rLic->fetch_array()){
                $lic= new Licencia($rL['numero'], $rL['costo'], $rL['tipo'], $rL['activa']);
                $lic->setIdLicencia($rL['idLicencia']);
                return $lic;
            }            
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
    }
    
    public function nuevaLicencia ($tipo, $activa, $idPersona){
        try{
            static::$bd->getConexion()->query("INSERT INTO licencia VALUES(null, E/T,'$tipo','$activa','$idPersona')");
        } catch(mysqli_sql_exception $ex){
            echo 'Error: '. $ex->getMessage();
        }
    }
    
    public function traerUltimoId(){
        $r=static::$bd->getConexion->query("SELECT MAX(idLicencia) AS id FROM licencia" )->fetch_array();
        return $r['id'];    
    }
    
    public function habilitaODeshabilita(Licencia $lic){
        try {
            if (!$lic->getActiva()) {
                static::$bd->getConexion->query("UPDATE licencia activa=true");
            }else {
                static::$bd->getConexion->query("UPDATE licencia activa=false");
            }
            
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
    }

}
