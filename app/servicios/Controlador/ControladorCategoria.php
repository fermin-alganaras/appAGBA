<?php

require_once '..\..\..\Modelo\Categoria.php';
class ControladorCategoria extends ControladorGeneral {
    
    function __construct() {
        
        
    }
    
    public function agregarCategoria($denominacion, $orden,  $modo, $tipoLicencia){
        try{
            ServidorControladores::getConBD()->getConexion()->query("INSERT INTO categoria VALUES('$denominacion','$orden',' 
                    $modo','$tipoLicencia')");
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
    }
    
    public function traerCategoriaXID($id){
        try{
            $r=ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM categoria WHERE idCategoria='$id'")->fetch_array();
            $cat= new Modelo\Categoria($r['denominacion'], $r['orden'], $r['modo'], $r['tipoLicencia']);
            $cat->setIdCategoria($r['idCategoria']);
            return $cat;
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
    } 
    
    public function traerUltimoId(){
        $r=ServidorControladores::getConBD()->getConexion()->query("SELECT MAX(idCategoria) AS id FROM categoria" )->fetch_array();
        return $r['id'];    
    }
    
    
    public function cambiaOrden($aPartirDe){
        try{
            
        } catch (Exception $ex) {

        }
    }
    
    

}