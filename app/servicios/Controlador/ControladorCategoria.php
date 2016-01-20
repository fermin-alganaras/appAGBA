<?php

require_once '..\..\..\Modelo\Categoria.php';
class ControladorCategoria {
    
    function __construct() {
        
        
    }
    
    public function agregarCategoria($denominacion, $orden,  $modo, $tipoLicencia, $escuela, $libre,
            $soloDance, $freeDance, $showPresicion, $solista, $pareja, $grupal, $tipoPersona){
        try{
            if ((($escuela==1 && $libre==1)|| ($escuela==1 || $libre==1)) && $tipoPersona==1) {
                $this->cambiaOrden($orden, 1);
                if(!ServidorControladores::getConBD()->getConexion()->query("INSERT INTO categoria VALUES(null,'$denominacion','$orden',' 
                    $modo','$tipoLicencia','$escuela','$libre','$soloDance','$freeDance','$showPresicion',"
                    . "'$solista','$pareja','$grupal',' $tipoPersona')")){
                    die(ServidorControladores::getConBD()->getConexion()->error . 'En el insert ');
                }
            }elseif((($soloDance==1 && freeDance==1) || ($soloDance==1 || $freeDance==1)) && $tipoPersona==1){
                $this->cambiaOrden($orden, 2);
                if(!ServidorControladores::getConBD()->getConexion()->query("INSERT INTO categoria VALUES(null,'$denominacion','$orden',' 
                    $modo','$tipoLicencia','$escuela','$libre','$soloDance','$freeDance','$showPresicion','"
                    . "$solista','$pareja','$grupal',' $tipoPersona'")){
                    die(ServidorControladores::getConBD()->getConexion()->error);
                }
            }elseif($showPresicion==1 && $tipoPersona==1){
                $this->cambiaOrden($orden, 3);
                if(!ServidorControladores::getConBD()->getConexion()->query("INSERT INTO categoria VALUES(null,'$denominacion','$orden',' 
                    $modo','$tipoLicencia','$escuela','$libre','$soloDance','$freeDance','$showPresicion','"
                    . "$solista','$pareja','$grupal',' $tipoPersona'")){
                    die(ServidorControladores::getConBD()->getConexion()->error);
                }
            }elseif($tipoPersona==2){
                $this->cambiaOrden($orden, 4);
                if(!ServidorControladores::getConBD()->getConexion()->query("INSERT INTO categoria VALUES(null,'$denominacion','$orden',' 
                    $modo','$tipoLicencia','$escuela','$libre','$soloDance','$freeDance','$showPresicion','"
                    . "$solista','$pareja','$grupal',' $tipoPersona'")){
                    die(ServidorControladores::getConBD()->getConexion()->error);
                }
            }else{
                $this->cambiaOrden($orden, 5);
                if(!ServidorControladores::getConBD()->getConexion()->query("INSERT INTO categoria VALUES(null,'$denominacion','$orden',' 
                    $modo','$tipoLicencia','$escuela','$libre','$soloDance','$freeDance','$showPresicion','"
                    . "$solista','$pareja','$grupal',' $tipoPersona'")){
                    die(ServidorControladores::getConBD()->getConexion()->error);
                }
            }
            return TRUE;
            
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
    }
    
    public function traerCategoriaXID($id){
        $cat=null;
        try{
            $r=ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM categoria WHERE idCategoria='$id'")->fetch_array();
            $cat= new Modelo\Categoria($r['denominacion'], $r['orden'], $r['modo'], $r['tipoLicencia'], $r['escuela'],
                    $r['libre'], $r['soloDance'], $r['freeDance'], $r['showPresicion'], $r['solista'], $r['pareja'],
                    $r['grupal'], $r['tipoPersona']);
            $cat->setIdCategoria($r['idCategoria']);
            
        } catch (mysqli_sql_exception $ex) {
            echo 'Error: '. $ex->getMessage();
        }
        return $cat;
    } 
    
    public function traerUltimoId(){
        $r=ServidorControladores::getConBD()->getConexion()->query("SELECT MAX(idCategoria) AS id FROM categoria" )->fetch_array();
        return $r['id'];    
    }
    
    public function traerCategoriasSolistasEscYLibre(){
        $categorias=array();
        try{
            if(!$r= ServidorControladores::getConBD()->getConexion()->query('SELECT * FROM categoria WHERE ((escuela=1 AND libre=1) '
                    . 'OR (escuela=1 OR libre=1)) AND (solista=1) AND (tipoPersona=1) AND (orden>0) ORDER BY orden')){
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            while($f= $r->fetch_array()){
                $c= new Modelo\Categoria($f['denominacion'], $f['orden'], $f['modo'], $f['tipoLicencia'], $f['escuela'],
                    $f['libre'], $f['soloDance'], $f['freeDance'], $f['showPresicion'], $f['solista'], $f['pareja'],
                    $f['grupal'], $f['tipoPersona']);
                $c->setIdCategoria($f['idCategoria']);
                array_push($categorias, $c);
            }
            
            return $categorias;
            
        } catch (mysqli_sql_exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public function traerCategoriasParejasLibre(){
        $categorias=array();
        try{
            if(!$r= ServidorControladores::getConBD()->getConexion()->query('SELECT * FROM categoria WHERE (libre=1) '
                    . 'AND (pareja=1) AND (tipoPersona=1) AND (orden>0) ORDER BY orden')){
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            while($f= $r->fetch_array()){
                $c= new Modelo\Categoria($f['denominacion'], $f['orden'], $f['modo'], $f['tipoLicencia'], $f['escuela'],
                    $f['libre'], $f['soloDance'], $f['freeDance'], $f['showPresicion'], $f['solista'], $f['pareja'],
                    $f['grupal'], $f['tipoPersona']);
                $c->setIdCategoria($f['idCategoria']);
                array_push($categorias, $c);
            }
            
            return $categorias;
            
        } catch (mysqli_sql_exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public function traerCategoriasSolistasDanza(){
        $categorias=array();
        try{
            if(!$r= ServidorControladores::getConBD()->getConexion()->query('SELECT * FROM categoria WHERE (soloDance=1 AND freeDance=1) '
                    . 'OR (soloDance=1 OR freeDance=1) AND (solista=1) AND (tipoPersona=1) AND (orden>0) ORDER BY orden')){
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            while($f= $r->fetch_array()){
                $c= new Modelo\Categoria($f['denominacion'], $f['orden'], $f['modo'], $f['tipoLicencia'], $f['escuela'],
                    $f['libre'], $f['soloDance'], $f['freeDance'], $f['showPresicion'], $f['solista'], $f['pareja'],
                    $f['grupal'], $f['tipoPersona']);
                $c->setIdCategoria($f['idCategoria']);
                array_push($categorias, $c);
            }
            
            return $categorias;
            
        } catch (mysqli_sql_exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public function traerCategoriasParejasDanza(){
        $categorias=array();
        try{
            if(!$r= ServidorControladores::getConBD()->getConexion()->query('SELECT * FROM categoria WHERE (soloDance=1 AND freeDance=1) '
                    . 'OR (soloDance=1 OR freeDance=1) AND (pareja=1) AND (tipoPersona=1) AND (orden>0) ORDER BY orden')){
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            while($f= $r->fetch_array()){
                $c= new Modelo\Categoria($f['denominacion'], $f['orden'], $f['modo'], $f['tipoLicencia'], $f['escuela'],
                    $f['libre'], $f['soloDance'], $f['freeDance'], $f['showPresicion'], $f['solista'], $f['pareja'],
                    $f['grupal'], $f['tipoPersona']);
                $c->setIdCategoria($f['idCategoria']);
                array_push($categorias, $c);
            }
            
            return $categorias;
            
        } catch (mysqli_sql_exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public function traerCategoriasShowPresicion(){
        $categorias=array();
        try{
            if(!$r= ServidorControladores::getConBD()->getConexion()->query('SELECT * FROM categoria WHERE (showPresicion=1) '
                    . 'AND (grupal=1) AND (tipoPersona=1) AND (orden>0) ORDER BY orden')){
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            while($f= $r->fetch_array()){
                $c= new Modelo\Categoria($f['denominacion'], $f['orden'], $f['modo'], $f['tipoLicencia'], $f['escuela'],
                    $f['libre'], $f['soloDance'], $f['freeDance'], $f['showPresicion'], $f['solista'], $f['pareja'],
                    $f['grupal'], $f['tipoPersona']);
                $c->setIdCategoria($f['idCategoria']);
                array_push($categorias, $c);
            }
            
            return $categorias;
            
        } catch (mysqli_sql_exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public function traerCategoriasTecnicos (){
        $categorias=array();
        try{
            if(!$r= ServidorControladores::getConBD()->getConexion()->query('SELECT * FROM categoria '
                    . 'WHERE (tipoPersona=2) AND (orden>0) ORDER BY orden')){
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            while($f= $r->fetch_array()){
                $c= new Modelo\Categoria($f['denominacion'], $f['orden'], $f['modo'], $f['tipoLicencia'], $f['escuela'],
                    $f['libre'], $f['soloDance'], $f['freeDance'], $f['showPresicion'], $f['solista'], $f['pareja'],
                    $f['grupal'], $f['tipoPersona']);
                $c->setIdCategoria($f['idCategoria']);
                array_push($categorias, $c);
            }
            
            return $categorias;
            
        } catch (mysqli_sql_exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public function cambiaOrden($orden, $grupo){
        try{
            switch ($grupo){
            case 1:
                if(!$r=ServidorControladores::getConBD()->getConexion()->query("SELECT idCategoria, orden FROM categoria"
                        . " WHERE tipoPersona=1 AND ((escuela=1 AND libre=1) "
                    . "OR (escuela=1 OR libre=1)) AND (orden>='$orden')")){
                    die(ServidorControladores::getConBD()->getConexion()->error . ' En el select de caso 1');
                }
                while ($f= $r->fetch_array()) {
                    $nO= $f['orden'] +1;
                    $id= $f['idCategoria'];
                    if (!ServidorControladores::getConBD()->getConexion()->query("UPDATE categoria SET orden='$nO'"
                            . " WHERE idCategoria='$id'")) {
                        die(ServidorControladores::getConBD()->getConexion()->error . ' En el update de caso 1');
                    }
                }
                break;
            case 2:
                if(!$r=ServidorControladores::getConBD()->getConexion()->query("SELECT idCategoria, orden FROM categoria"
                        . "WHERE tipoPersona=1 AND ((soloDance=1 AND freeDance=1) "
                    . "OR (soloDance=1 OR freeDance=1)) AND orden>='$orden'")){
                    die(ServidorControladores::getConBD()->getConexion()->error);
                }
                while ($f= $r->fetch_array()) {
                    $nO= $f['orden'] +1;
                    $id= $f['idCategoria'];
                    if (!ServidorControladores::getConBD()->getConexion()->query("UPDATE categoria SET orden='$nO'"
                            . " WHERE idCategoria='$id'")) {
                        die(ServidorControladores::getConBD()->getConexion()->error);
                    }
                }
                break;
            case 3:
                if(!$r=ServidorControladores::getConBD()->getConexion()->query("SELECT idCategoria, orden FROM categoria"
                        . "WHERE tipoPersona=1 AND ((showPresicion=1) "
                    . "AND orden>='$orden'")){
                    die(ServidorControladores::getConBD()->getConexion()->error);
                }
                while ($f= $r->fetch_array()) {
                    $nO= $f['orden'] +1;
                    $id= $f['idCategoria'];
                    if (!ServidorControladores::getConBD()->getConexion()->query("UPDATE categoria SET orden='$nO'"
                            . " WHERE idCategoria='$id'")) {
                        die(ServidorControladores::getConBD()->getConexion()->error);
                    }
                }
                break;
            case 4:
                if(!$r=ServidorControladores::getConBD()->getConexion()->query("SELECT idCategoria, orden FROM categoria"
                        . "WHERE tipoPersona=2 AND orden>='$orden'")){
                    die(ServidorControladores::getConBD()->getConexion()->error);
                }
                while ($f= $r->fetch_array()) {
                    $nO= $f['orden'] +1;
                    $id= $f['idCategoria'];
                    if (!ServidorControladores::getConBD()->getConexion()->query("UPDATE categoria SET orden='$nO'"
                            . " WHERE idCategoria='$id'")) {
                        die(ServidorControladores::getConBD()->getConexion()->error);
                    }
                }
                break;
            case 5:
                if(!$r=ServidorControladores::getConBD()->getConexion()->query("SELECT idCategoria, orden FROM categoria"
                        . "WHERE tipoPersona=3 AND orden>='$orden'")){
                    die(ServidorControladores::getConBD()->getConexion()->error);
                }
                while ($f= $r->fetch_array()) {
                    $nO= $f['orden'] +1;
                    $id= $f['idCategoria'];
                    if (!ServidorControladores::getConBD()->getConexion()->query("UPDATE categoria SET orden='$nO'"
                            . " WHERE idCategoria='$id'")) {
                        die(ServidorControladores::getConBD()->getConexion()->error);
                    }
                }
            }   
        } catch (mysqli_sql_exception $ex) {
            die($ex->getMessage());
        }
    }
    
    public function eliminaCategoria($id){
        try {
            if(!ServidorControladores::getConBD()->getConexion()->query("UPDATE categoria SET orden=0 "
                    . "WHERE idCategoria='$id'") ){
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            return TRUE;
        } catch (Exception $ex) {
           die($ex->getMessage()); 
        }
    }
    
    public function getOrdenCat($idCat){
        $orden=null;
        try {
            if(!$r=  ServidorControladores::getConBD()->getConexion()->query("SELECT orden FROM categoria WHERE idCategoria='$idCat'")){
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            while ($f=$r->fetch_array()){
                $orden=$f['orden'];
            }
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        return $orden;
    }
    
    public function defineCat(Modelo\Patinador $pat){
        if (($pat->getCatEsc()->getOrden()>$pat->getCatLibre()->getOrden())) {
            return $pat->getCatEsc();
        }elseif(($pat->getCatEsc()->getOrden()<$pat->getCatLibre()->getOrden())){
            return $pat->getCatLibre();
        }elseif ($pat->getCatEsc()==NULL && $pat->getCatLibre()==NULL &&
                $pat->getCatSoloDance()->getOrden()<$pat->getCatFreeDance()->getOrden()  ) {
            return $pat->getCatSoloDance();
        }  else {
            return $pat->getCatFreeDance();
        }
    }

}
