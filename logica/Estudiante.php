<?php
class Estudiante {

    public $K_CODEST;
    public $N_NOMEST;
    public $N_PROYECTOEST;
    public $N_DIREST;
    public $N_CORREOEST;
    public $N_FACEST;
    public $I_ESTADOEST;
    public $V_PROMEST;
    public $Q_ASIGPERDEST;

    public function __construct($K_CODEST,$N_NOMEST,$N_PROYECTOEST,$N_DIREST,$N_CORREOEST,$N_FACEST,$I_ESTADOEST, $V_PROMEST,$Q_ASIGPERDEST) {
     $this->K_CODEST=$K_CODEST;
     $this->N_NOMEST=$N_NOMEST;
     $this->N_PROYECTOEST=$N_PROYECTOEST;
     $this->N_DIREST=$N_DIREST;
     $this->N_CORREOEST=$N_CORREOEST;
     $this->N_FACEST=$N_FACEST;
     $this->I_ESTADOEST=$I_ESTADOEST;
     $this->V_PROMEST=$V_PROMEST;
     $this->Q_ASIGPERDEST=$Q_ASIGPERDEST;

   }

    public function getK_CODEST(){
      return $this->K_CODEST;
    }

    public function setK_CODEST($K_CODEST){
      $this->K_CODEST = $K_CODEST;
    }

    public function getN_NOMEST(){
      return $this->N_NOMEST;
    }

    public function setN_NOMEST($N_NOMEST){
      $this->N_NOMEST = $N_NOMEST;
    }

    public function getN_PROYECTOEST(){
      return $this->N_PROYECTOEST;
    }

    public function setN_PROYECTOEST($N_PROYECTOEST){
      $this->N_PROYECTOEST = $N_PROYECTOEST;
    }

    public function getN_DIREST(){
      return $this->N_DIREST;
    }

    public function setN_DIREST($N_DIREST){
      $this->N_DIREST = $N_DIREST;
    }

    public function getN_CORREOEST(){
      return $this->N_CORREOEST;
    }

    public function setN_CORREOEST($N_CORREOEST){
      $this->N_CORREOEST = $N_CORREOEST;
    }

    public function getN_FACEST(){
      return $this->N_FACEST;
    }

    public function setN_FACEST($N_FACEST){
      $this->N_FACEST = $N_FACEST;
    }

    public function getI_ESTADOEST(){
      return $this->I_ESTADOEST;
    }

    public function setI_ESTADOEST($I_ESTADOEST){
      $this->I_ESTADOEST = $I_ESTADOEST;
    }

    public function getV_PROMEST(){
      return $this->V_PROMEST;
    }

    public function setV_PROMEST($V_PROMEST){
      $this->V_PROMEST = $V_PROMEST;
    }

    public function getQ_ASIGPERDEST(){
      return $this->Q_ASIGPERDEST;
    }

    public function setQ_ASIGPERDEST($Q_ASIGPERDEST){
      $this->Q_ASIGPERDEST = $Q_ASIGPERDEST;
    }
}
 ?>
