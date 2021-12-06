<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/AtualOrdemCarregDAO.class.php');
require_once('../model/BagCarregDAO.class.php');
require_once('../model/FuncDAO.class.php');
require_once('../model/OrdemCarregDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR {
    //put your code here
    private $base = 2;
    private $baseApex = 3;

    public function dadosBag($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        $bagCarregDAO = new BagCarregDAO();
        
        if($versao >= 1.00){
        
            $dados = array("dados"=>$bagCarregDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosFunc($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        $funcDAO = new FuncDAO();
        
        if($versao >= 1.00){
        
            $dados = array("dados"=>$funcDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosOrdemCarreg($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        $atualOrdemCarregDAO = new AtualOrdemCarregDAO();
        $ordemCarregDAO = new OrdemCarregDAO();
        
        if($versao >= 1.00){
        
            //$atualOrdemCarregDAO->atualOrdemCarreg($this->baseApex);
            $dados = array("dados"=>$ordemCarregDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
}
