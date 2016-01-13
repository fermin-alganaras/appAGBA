<?php

require_once '..\..\..\Modelo\ListaBnaFe.php';

class ControladorListaBnaFe {
    
    public function nuevaLista($idClub, $fechaCreacion, $idTorneo, $patinadores, $parejas, $grupales, $tD){
        try {
           
            $pat= $patinadores;
            $par=  $parejas;
            $gru= $grupales;
            $tecDeg= $tD;
            $lista=array(
                'patinadores'=>$pat,
                'parejas'=>$par,
                'grupales'=>$gru,
                'tecDeg'=>$tecDeg    
                    );
            $nombreArchivo=$idTorneo.'-'.$idClub.'.json';
            $a= fopen("..\\..\\..\\ListasDeBuenaFe\\$nombreArchivo", "w+");
            fwrite($a, json_encode($lista));
            if (!ServidorControladores::getConBD()->getConexion()->query("INSERT INTO listabnafe VALUES(null,'$fechaCreacion','$nombreArchivo','$idClub','$idTorneo')")) {
                die('Error en la query de lista de buena fe');
            }
            return TRUE;
        } catch (mysqli_sql_exception $ex) {
            die($ex->getMessage());
        } catch (Exception $ex){
            die("Excepcion varia:'$ex->getMessage()'" );
        }
    }
    
    public function traerLista($idLista){
        $lista= null;
        try {
            if(!$r=ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM listabnafe "
                    . "WHERE idListaBnaFe='$idLista'")){
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            while($l=$r->fetch_array()){
                $lista= new Modelo\ListaBnaFe($l['fechaCreacion'], $l['idTorneo'], $l['idClub']);
                $nArch=$l['refArchivo'];
                $dir="..\\..\\..\\ListasDeBuenaFe\\$nArch";
                //$archivo=  fopen($dir, 'r');
                $datos= file_get_contents($dir);
                $arrayDatos= json_decode($datos);
                $this->descodificaDatos($arrayDatos, $lista);
            }
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        return $lista;
    }
    
    private function descodificaDatos( $datos, $lista){
        foreach ($datos->patinadores AS $i){
            $item= new Modelo\ItemListaSolista($i->idPatinador, $i->idCategoria, $i->esc, $i->libr, 
                    $i->solo, $i->free);
            array_push($lista->getInfoLista(), $item);
        }
        foreach ($datos->parejas AS $p){
             $item= new Modelo\ItemListaPareja($p->idPatCab, $p->idPatDam, $p->idCategoria, $p->libr, 
                    $p->solo, $p->free);
            array_push($lista->getInfoLista(), $item);
        }
        
        foreach ($datos->grupales AS $g){
             $item= new Modelo\ItemListaGrupal($g->nombreGrupal, $g->idsPatinadores, 
                    $g->idCategoria);
            array_push($lista->getInfoLista(), $item);
        }
        
        foreach ($datos->tecDeg AS $td ){
             $item= new Modelo\ItemListaTecDel($td->idTecDel, $td->tipo);
            array_push($lista->getInfoLista(), $item);
        }
        
    }
    
    public function traerListasXTorneo($idTorneo){
        $array_listas= array();
        
        try {
            if (!$r=ServidorControladores::getConBD()->getConexion()->query("SELECT * FROM listaBnaFe WHERE idTorneo='$idTorneo'")){
                die(ServidorControladores::getConBD()->getConexion()->error);
            }
            while ($f= $r->fetch_array()) {
                $lista= new Modelo\ListaBnaFe($f['fechaCreacion'], $f['idTorneo'], $f['idClub']);
                $nArch=$f['nombreArchivo'];
                $dir="..\ListasDeBuenaFe\'$lista->getIdTorneo()'\'$nArch'";
                $archivo=  fopen($dir, 'r');
                $datos= file_get_contents($archivo);
                $arrayDatos= json_decode($datos);
                $this->descodificaDatos($arrayDatos, $lista);
                array_push($array_listas, $lista);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        return $array_listas;
    }
}


