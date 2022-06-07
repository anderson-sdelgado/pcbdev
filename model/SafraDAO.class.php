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
                    . " , TO_CHAR(P.DT_INIC, 'DD/MM/YYYY') AS \"dataInicioSafra\" "
                . " FROM "
                    . " USINAS.V_BAG_ESTOQ B "
                    . " , PERIOD_ATIV_PROD P "
                . " WHERE "
                    . " B.PERIODPROD_ID = P.PERIODPROD_ID ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
