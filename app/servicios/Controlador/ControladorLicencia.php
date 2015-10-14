<?php

require_once '..\..\..\Modelo\Licencia.php';
class ControladorLicencia extends ControladorGeneral{
    
    function __construct() {
        parent::__construct();
    }
    
    public function traerLicenciaXIdPersona($id){
        try {
            $rLic= static::$bd->getConexion()->query("SELECT * FROM licencia WHERE idPersona='$id");
            while($rL=$rLic->fetch_array()){
                $lic= new Modelo\Licencia($rL['numero'], $rL['tipo'], $rL['activa']);
                $lic->setIdLicencia($rL['idLicencia']);
                return $lic;
            }            
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
    }
    
    public function nuevaLicencia ($tipo, $activa){
        try{
            static::$bd->getConexion()->query("INSERT INTO licencia VALUES(null, E/T,'$tipo','$activa')");
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
            if (!$lic->getActiva()==true) {
                $id= $lic->getIdLicencia();
                static::$bd->getConexion->query("UPDATE licencia SET (activa=true) WHERE idLicencia='$id" );
            }else {
                static::$bd->getConexion->query("UPDATE licencia SET (activa=false) WHERE idLicencia='$id");
            }
            
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
    }

}
