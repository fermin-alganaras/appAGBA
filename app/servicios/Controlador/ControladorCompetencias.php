<?php

class ControladorCompetencias {

    private $conCat;
    private $conPat;

    function __construct() {
        $this->conCat = ServidorControladores::getConCategoria();
        $this->conPat = ServidorControladores::getConPatinador();
    }

    private function nuevaCompetencia(array $competencias, $idCat, $edad, $sexo, $tipo, $primerComp) {
        if ($sexo == 'F') {
            $s = 'DAMAS';
        } else {
            $s = 'CABALLEROS';
        }
        $den = $edad . 'AÑOS ' . $s . ' ' . $this->conCat->traerCategoriaXID($idCat)->getDenominacion();
        $comp = new Modelo\Competencia($den, $edad, $idCat, $sexo, $tipo);
        array_push($comp->getCompetidores(), $primerComp);
        array_push($competencias, $comp);
    }

    public function ordenarCompetencias(array $competencias) {
        for ($i = 0; $i < array_count_values($competencias); $i++) {
            for ($j = 0; $j < (array_count_values($competencias) - 1); $j++) {
                $actual = $competencias[$j];
                $sig = $competencias[$j + 1];
                if ($this->conCat->getOrdenCat($actual->getIdCat()) > $this->conCat->getOrdenCat($sig->getIdCat())) {
                    $competencias[$j + 1] = $actual;
                    $competencias[$j] = $sig;
                }
            }
        }
        for ($i = 0; $i < array_count_values($competencias); $i++) {
            for ($j = 0; $j < (array_count_values($competencias) - 1); $j++) {
                $actual = $competencias[$j];
                $sig = $competencias[$j + 1];
                if (($actual->getIdCat() == $sig->getIdCat()) && ($actual->getEdad() > $sig->getEdad())) {
                    $competencias[$j + 1] = $actual;
                    $competencias[$j] = $sig;
                }
            }
        }
    }

    public function agregarCompetidorACompetencia(array $competencias, $itemLista) {
        $ubico = FALSE;
        $i = 0;
        while (ubico == FALSE) {
            if ($itemLista instanceof Modelo\ItemListaSolista) {
                foreach ($competencias as $comp) {
                    if (($comp->getEdad() == $this->conPat()->calculaEdad($itemLista->getIdPatinador())
                            && ($comp->getTipo() == 1) && ($comp->getIdCat == $itemLista->getIdCategoria())
                            && ($comp->getSexo()==$this->conPat->getSexoPatinador($itemLista->getIdPatinador())))) {
                        $competidor = new Modelo\CompetidorSolista($itemLista->getIdPatinador(), $itemLista->getEsc(), $itemLista->getLibr(), $itemLista->getSolo(), $itemLista->getFree());
                        array_push($comp->getCompetidores(), $competidor);
                        $ubico = TRUE;
                        break;
                    }
                }
                if (!$ubico) {
                    $competidor = new Modelo\CompetidorSolista($itemLista->getIdPatinador(), $itemLista->getEsc(), $itemLista->getLibr(), $itemLista->getSolo(), $itemLista->getFree());
                    $this->nuevaCompetencia($competencias, $itemLista->getIdCategoria(), $this->conPat->calculaEdad($itemLista->getIdPatinador()), $this->conPat->getSexoPatinador($itemLista->getIdPatinador()), 1, $competidor);
                    $ubico = TRUE;
                }
            } elseif ($itemLista instanceof \Modelo\ItemListaPareja) {
                if ($this->conPat->calculaEdad($itemLista->getIdPatCab()) >= $this->conPat->calculaEdad($itemLista->getIdPatDam())) {
                    $edad= $this->conPat->calculaEdad($itemLista->getIdPatCab());
                }else{
                    $edad=$this->conPat->calculaEdad($itemLista->getIdPatDam());
                }
                    
                foreach ($competencias as $comp) {
                    if (($comp->getEdad() == $edad && ($comp->getTipo() == 2) && ($comp->getIdCat == $itemLista->getIdCategoria()))) {
                        $competidor = new Modelo\CompetidorPareja($itemLista->getIdPatDam(), $itemLista->getIdPatCab(), $itemLista->getLibr(), $itemLista->getSolo(), $itemLista->getFree());
                        array_push($comp->getCompetidores(), $competidor);
                        $ubico = TRUE;
                        break;
                    }
                }
                if (!$ubico) {
                    $competidor = new Modelo\CompetidorPareja($itemLista->getIdPatDam(), $itemLista->getIdPatCab(), $itemLista->getLibr(), $itemLista->getSolo(), $itemLista->getFree());
                    $this->nuevaCompetencia($competencias, $itemLista->getIdCategoria(), $edad, 'PM', 2, $competidor);
                    $ubico = TRUE;
                }
            }elseif ($itemLista instanceof \Modelo\CompetidorGrupal) {
                $cat=null;
                if ($this->mayorEdad($itemLista->getIdPat())>13) {
                    $cat='MAYORES';
                }else{
                    $cat='MENORES';
                }                    
                foreach ($competencias as $comp) {
                    if (($comp->getEdad() == $cat && ($comp->getTipo() == 3) && ($comp->getIdCat == $itemLista->getIdCategoria()))) {
                        $competidor = new Modelo\CompetidorGrupal($itemLista->getIdPat, $itemLista->getLibr());
                        array_push($comp->getCompetidores(), $competidor);
                        $ubico = TRUE;
                        break;
                    }
                }
                if (!$ubico) {
                    $competidor = new Modelo\CompetidorGrupal($itemLista->getIdPat, $itemLista->getLibr());
                    $this->nuevaCompetencia($competencias, $itemLista->getIdCategoria(), $cat, ' ', 3, $competidor);
                    $ubico = TRUE;
                }
            }
        }
    }
    
    private function mayorEdad(array $ids){
        $edad=0;
        foreach ($ids as $id) {
            $e=$this->conPat-calculaEdad($id);
            if ($e > $edad) {
                $edad=$e;
            }
        }
        
        return $edad;
    }
    
    public function getCompetencias($idTorneo){
        $competencias=array();
        try{
            $dir="..\TorneoData\'$idTorneo'.json";
            $arch= file($dir);
            $datos= file_get_contents($arch);
            $array_datos= json_decode($datos);
            foreach ($array_datos as $comp) {
                $c= new Modelo\Competencia($comp->denominacion, $comp->edad, $comp->idCat, $comp->sexo, $comp->tipo);
                $c->setCompetidores($this->cargarCompetidores($comp->competidores));
                array_push($competencias, $c);
            }
                
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        return $competencias;
    }
    
    private function cargarCompetidores($datos){
        $competidores=array();
        try{
            foreach ($datos as $comp) {
                if ($comp->tipo==1) {
                    $c=new \Modelo\CompetidorSolista($comp->idPat, $comp->esc, $comp->libr, $comp->sd, $comp->fd);
                    $c->setREsc($comp->rEsc);
                    $c->setRLibr($comp->rLibr);
                    $c->setRSd($comp->rSd);
                    $c->setRFd($comp->rF0d);
                    array_push($competidores, $c);
                }elseif($comp->tipo==2){
                    $c=new \Modelo\CompetidorPareja($comp->idDama, $comp->idCab, $comp->libr, $comp->sd, $comp->fd);
                    $c->setRLibr($comp->rLibr);
                    $c->setRSd($comp->rSd);
                    $c->setRFd($comp->rF0d);
                    array_push($competidores, $c);
                }else{
                    $c=new \Modelo\CompetidorGrupal($comp->idPat, $comp->libr);
                    $c->setRLibr($comp->rLibr);
                    array_push($competidores, $c);
                }
            }
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        return $competidores;
    }
    
    public function cargarResultados(array $resultados, \Modelo\Competencia $competencia){
        if ($competencia->getTipo()==1) {
            foreach ($resultados as $k=> $r) {
                $competencia->getCompetidores()[$k]->setREsc($r->rEsc);
                $competencia->getCompetidores()[$k]->setRLibr($r->rLibr);
                $competencia->getCompetidores()[$k]->setRSd($r->rSd);
                $competencia->getCompetidores()[$k]->setRFd($r->rFd);
            }
        }elseif ($competencia->getTipo()==2) {
            foreach ($resultados as $k=> $r) {
                $competencia->getCompetidores()[$k]->setRLibr($r->rLibr);
                $competencia->getCompetidores()[$k]->setRSd($r->rSd);
                $competencia->getCompetidores()[$k]->setRFd($r->rFd);
            }
        }else{
            foreach ($resultados as $k=> $r) {
                $competencia->getCompetidores()[$k]->setRLibr($r->rLibr);
            }
        }
    }
    
    

}
