<?php
class Soporte {
    
    public $K_IDSOP;
    public $O_DOCSOP; 
    public $N_VALORSOP;
    public $I_ESTADOSOP;
    public $Q_PUNTAJESOP;
    public $K_IDSOL;
    public $K_IDCOND;

    public function __construct($K_IDSOP,$O_DOCSOP,$N_VALORSOP,$K_IDCOND) {
        $this->K_IDSOP=$K_IDSOP;
        $this->O_DOCSOP=$O_DOCSOP;
        $this->N_VALORSOP=$N_VALORSOP;
        $this->K_IDCOND=$K_IDCOND;        
    }

    public function getK_IDSOP(){
        return $this->K_IDSOP;
    }

    public function setK_IDSOP($K_IDSOP){
        $this->K_IDSOP = $K_IDSOP;
    }

    public function getO_DOCSOP(){
        return $this->O_DOCSOP;
    }

    public function setO_DOCSOP($O_DOCSOP){
        $this->O_DOCSOP = $O_DOCSOP;
    }

    public function getN_VALORSOP(){
        return $this->N_VALORSOP;
    }

    public function setN_VALORSOP($N_VALORSOP){
        $this->N_VALORSOP = $N_VALORSOP;
    }

    public function getI_ESTADOSOP(){
        return $this->I_ESTADOSOP;
    }

    public function setI_ESTADOSOP($I_ESTADOSOP){
        $this->I_ESTADOSOP = $I_ESTADOSOP;
    }

    public function getQ_PUNTAJESOP(){
        return $this->Q_PUNTAJESOP;
    }

    public function setQ_PUNTAJESOP($Q_PUNTAJESOP){
        $this->Q_PUNTAJESOP = $Q_PUNTAJESOP;
    }

    public function getK_IDSOL(){
        return $this->K_IDSOL;
    }

    public function setK_IDSOL($K_IDSOL){
        $this->K_IDSOL = $K_IDSOL;
    }

    public function getK_IDCOND(){
        return $this->K_IDCOND;
    }

    public function setK_IDCOND($K_IDCOND){
        $this->K_IDCOND = $K_IDCOND;
    }

}

?>