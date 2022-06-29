<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of SafraDAO
 *
 * @author anderson
 */
class SafraDAO extends Conn {
    
    public function dados() {

        $select = " SELECT DISTINCT "
                    . " P.PERIODPROD_ID AS \"idSafra\" "
                    . " , P.NOME AS \"descrSafra\" "
                    . " , DECODE(PMAX.PERIODPROD_ID, null, 0, 1) AS \"atualSafra\" "
                . " FROM "
                    . " USINAS.V_BAG_ESTOQ B "
                    . " , USINAS.PERIOD_ATIV_PROD P "
                    . " , (SELECT " 
                            . " MAX(PERIODPROD_ID) AS PERIODPROD_ID "
                      . " FROM "
                            . " USINAS.PERIOD_ATIV_PROD "
                      . " WHERE " 
                            . " TP = 1 "
                            . " AND "
                            . " DT_INIC <= SYSDATE "
                            . " AND "
                            . " EMPRUSU_ID = 1 "
                            . " AND " 
                            . " NOME NOT LIKE '%SOJA%') PMAX "
                . " WHERE "
                    . " B.PERIODPROD_ID = P.PERIODPROD_ID"
                    . " AND "
                    . " P.PERIODPROD_ID = PMAX.PERIODPROD_ID(+) ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
