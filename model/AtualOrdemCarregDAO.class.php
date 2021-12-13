<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/ConnApex.class.php');
/**
 * Description of OrdemCarregDAO
 *
 * @author anderson
 */
class AtualOrdemCarregDAO extends ConnAPEX {
    //put your code here
    
    public function atualOrdemCarreg($base) {

        $sql = " call pk_capf7_apex.pb_ord_carregando ( e_user           => 'PCB_LEITOR_CD_BARRA' "
                    . " , e_session        => 'PCB_LEITOR_CD_BARRA' "
                    . " , e_emprusu_id     => 1 )";
        $this->Conn = parent::getConn($base);
        $stmt = $this->Conn->prepare($sql);
        $stmt->execute();
    }
    
}
