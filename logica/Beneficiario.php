<?php
class Beneficiario {

    public $K_ID_BENEF;
    public $K_IDSOL;
    public $I_ESTADOBENEF;
    public $K_IDSUB;    

    public function __construct($K_ID_BENEF,$K_IDSOL,$I_ESTADOBENEF,$K_IDSUB) {
     $this->K_ID_BENEF=$K_ID_BENEF;
     $this->K_IDSOL=$K_IDSOL;
     $this->I_ESTADOBENEF=$I_ESTADOBENEF;
     $this->K_IDSUB=$K_IDSUB;     
   }
}
 ?>
