<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/OCIAPEX.class.php');
/**
 * Description of OrdemCarregDAO
 *
 * @author anderson
 */
class AtualOrdemCargaDAO extends OCIAPEX {
    //put your code here
    
    public function atualOrdemCarga() {

        $sql = "BEGIN pk_capf7_apex.pb_ord_carregando ( e_user           => 'PCB_LEITOR_CD_BARRA' "
                    . " , e_session        => 'PCB_LEITOR_CD_BARRA' "
                    . " , e_emprusu_id     => 1 ); COMMIT; END;";
        
        $this->Conn = parent::getConn();
        $stid = oci_parse($this->Conn, $sql);
        oci_execute($stid);

    }
    
}
