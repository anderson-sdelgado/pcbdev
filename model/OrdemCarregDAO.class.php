<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of OrdemCarregDAO
 *
 * @author anderson
 */
class OrdemCarregDAO extends Conn {
    //put your code here
    
    public function dados($base) {

        $select = "SELECT "
                        . " ORDCARREG_ID AS \"idOrdemCarreg\" "
                        . " , DECODE(DEST_EXP, 'SIM', 1, 2) AS \"destExpOrdemCarreg\" "
                        . " , TICKET AS \"ticketOrdemCarreg\" "
                        . " , PRODUTO AS \"produtoOrdemCarreg\" "
                        . " , CLASSIF AS \"classifOrdemCarreg\" "
                        . " , QT_EMBAL AS \"qtdeEmbProdOrdemCarreg\" "
                        . " , PERIODPROD_ID AS \"idPeriodProdOrdemCarreg\" "
                        . " , EMPRUSU_ID AS \"idEmprUsuOrdemCarreg\" "
                        . " , EMBPROD_ID AS \"idEmbProdOrdemCarreg\" "
                    . " FROM " 
                        . " V_ORDEM_BAG_CARREGANDO ";
        
        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
