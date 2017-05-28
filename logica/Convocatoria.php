<?php
class Convocatoria {

    private $F_INICONV;
    private $F_FINCONV;
    private $F_CREACIONCONV;
    private $V_COSTOALMUERZO;
    private $Q_CUPOSDISP;
    private $I_ESTADOCONV;
    private $K_CEDADMIN;
    private $K_IDPERACAD;
    private $K_IDANIOCONV;

    public function __construct($F_INICONV, $F_FINCONV, $V_COSTOALMUERZO, $Q_CUPOSDISP,$I_ESTADOCONV,$K_IDANIOCONV) {
        $this->F_INICONV=$F_INICONV;
        $this->F_FINCONV=$F_FINCONV;
        $this->V_COSTOALMUERZO=$V_COSTOALMUERZO;
        $this->Q_CUPOSDISP=$Q_CUPOSDISP;
        $this->I_ESTADOCONV=$I_ESTADOCONV;
        $this->K_IDANIOCONV=$K_IDANIOCONV;
    }


    public function getF_INICONV(){
        return $this->F_INICONV;
    }

    public function setF_INICONV($F_INICONV){
        $this->F_INICONV = $F_INICONV;
    }

    public function getF_FINCONV(){
        return $this->F_FINCONV;
    }

    public function setF_FINCONV($F_FINCONV){
        $this->F_FINCONV = $F_FINCONV;
    }

    public function getF_CREACIONCONV(){
        return $this->F_CREACIONCONV;
    }

    public function setF_CREACIONCONV($F_CREACIONCONV){
        $this->F_CREACIONCONV = $F_CREACIONCONV;
    }

    public function getV_COSTOALMUERZO(){
        return $this->V_COSTOALMUERZO;
    }

    public function setV_COSTOALMUERZO($V_COSTOALMUERZO){
        $this->V_COSTOALMUERZO = $V_COSTOALMUERZO;
    }

    public function getQ_CUPOSDISP(){
        return $this->Q_CUPOSDISP;
    }

    public function setQ_CUPOSDISP($Q_CUPOSDISP){
        $this->Q_CUPOSDISP = $Q_CUPOSDISP;
    }

    public function getI_ESTADOCONV(){
        return $this->I_ESTADOCONV;
    }

    public function setI_ESTADOCONV($I_ESTADOCONV){
        $this->I_ESTADOCONV = $I_ESTADOCONV;
    }

    public function getK_CEDADMIN(){
        return $this->K_CEDADMIN;
    }

    public function setK_CEDADMIN($K_CEDADMIN){
        $this->K_CEDADMIN = $K_CEDADMIN;
    }

    public function getK_IDPERACAD(){
        return $this->K_IDPERACAD;
    }

    public function setK_IDPERACAD($K_IDPERACAD){
        $this->K_IDPERACAD = $K_IDPERACAD;
    }

    public function getK_IDANIOCONV(){
        return $this->K_IDANIOCONV;
    }

    public function setK_IDANIOCONV($K_IDANIOCONV){
        $this->K_IDANIOCONV = $K_IDANIOCONV;
    }


}

?>
