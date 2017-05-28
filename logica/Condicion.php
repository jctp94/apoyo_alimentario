<?php
class Condicion {
    
    private $K_IDCOND;
    private $Q_PUNTAJECOND; //Tipo de dato: Number de longitud 3. No nulo. ej o.09
    private $N_DESCCOND;
    private $I_IDTIPOCOND;// Ingresos familiares: 1.   - Condiciones familiares: 2.    - Procedencia y lugar de residencia: 3.     - Condiciones de salud: 4.  Tipo de dato: Number de longitud 1, no nulo.

    public function __construct($K_IDCOND, $Q_PUNTAJECOND, $N_DESCCOND, $I_IDTIPOCOND) { 
        $this->K_IDCOND=$K_IDCOND;
        $this->Q_PUNTAJECOND=$Q_PUNTAJECOND;        
        $this->N_DESCCOND=$N_DESCCOND;
        $this->I_IDTIPOCOND=$I_IDTIPOCOND;        
    }
    
    public function getK_IDCOND(){
        return $this->K_IDCOND;
    }

    public function setK_IDCOND($K_IDCOND){
        $this->K_IDCOND = $K_IDCOND;
    }

    public function getQ_PUNTAJECOND(){
        return $this->Q_PUNTAJECOND;
    }

    public function setQ_PUNTAJECOND($Q_PUNTAJECOND){
        $this->Q_PUNTAJECOND = $Q_PUNTAJECOND;
    }

    public function getN_DESCCOND(){
        return $this->N_DESCCOND;
    }

    public function setN_DESCCOND($N_DESCCOND){
        $this->N_DESCCOND = $N_DESCCOND;
    }

    public function getI_IDTIPOCOND(){
        return $this->I_IDTIPOCOND;
    }

    public function setI_IDTIPOCOND($I_IDTIPOCOND){
        $this->I_IDTIPOCOND = $I_IDTIPOCOND;
    }


}

?>