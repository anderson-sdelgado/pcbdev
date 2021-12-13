<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/LogEnvioDAO.class.php');
require_once('../model/CabecCarregDAO.class.php');
require_once('../model/ItemCarregDAO.class.php');
/**
 * Description of CarregCTR
 *
 * @author anderson
 */
class CarregCTR {
    //put your code here
    
    public function salvarDados($versao, $info, $pagina) {

        $dados = $info['dado'];
        $this->salvarLog($dados, $pagina, $versao);
        $versao = str_replace("_", ".", $versao);

        if ($versao >= 2.00) {

            $pos1 = strpos($dados, "_") + 1;

            $cabec = substr($dados, 0, ($pos1 - 1));
            $item = substr($dados, $pos1);
            
            $cabecJsonObj = json_decode($cabec);
            $itemJsonObj = json_decode($item);
            
            $cabecDados = $cabecJsonObj->cabec;
            $itemDados = $itemJsonObj->item;

            $ret = $this->salvarCabec($cabecDados, $itemDados);

            return $ret;
        }
    }
    
    private function salvarCabec($cabecDados, $itemDados) {
        
        $cabecCarregDAO = new CabecCarregDAO();
        $idCabecArray = array();
        
        foreach ($cabecDados as $cabec) {
            if($cabec->statusCabecCarreg === 1){
                $v = $cabecCarregDAO->verifCabec($cabec, $this->base);
                if ($v == 0) {
                    $cabecCarregDAO->insCabecAberto($cabec, $this->base);
                }
                $idCabecBD = $cabecCarregDAO->idCabec($cabec, $this->base);
                $retApont = $this->salvarItem($idCabecBD, $cabec->idCabec, $itemDados);
            }
            else{
                $v = $cabecCarregDAO->verifCabec($cabec, $this->base);
                if ($v == 0) {
                    $cabecCarregDAO->insCabecFechado($cabec, $this->base);
                    $idCabecBD = $cabecCarregDAO->idCabec($cabec, $this->base);
                } else {
                    $idCabecBD = $cabecCarregDAO->idCabec($cabec, $this->base);
                    $cabecCarregDAO->updateCabecFechado($idCabecBD, $cabec, $this->base);
                }
                $retApont = $this->salvarItem($idCabecBD, $cabec->idCabecCarreg, $itemDados);
            }
            $idCabecArray[] = array("idCabecCarreg" => $cabec->idCabecCarreg);
        }
        
        $cabecRet = json_encode(array("cabec"=>$idCabecArray));
        return 'RETORNO_' . $cabecRet . "|" . $retApont;
        
    }
    
    private function salvarItem($idCabecBD, $idCabecCel, $itemDados){
        
        $itemCarregDAO = new ItemCarregDAO;
        $idItemArray = array();
        
        foreach ($itemDados as $item) {
            if ($idCabecCel == $item->idCabecItemCarreg) {
                $v = $itemCarregDAO->verifItem($idCabecBD, $item, $this->base);
                if ($v == 0) {
                    $itemCarregDAO->insItem($idCabecBD, $item, $this->base);
                }
                $idCabecBD = $itemCarregDAO->idItem($idCabecBD, $item, $this->base);
                $idItemArray[] = array("idItemCarreg" => $item->idItemCarreg);
            }
        }
        $retItem = json_encode(array("item"=>$idItemArray));
        return $retItem;
    }
    
}
