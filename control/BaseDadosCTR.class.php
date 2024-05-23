<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../control/AtualAplicCTR.class.php');
require_once('../model/AtualOrdemCargaDAO.class.php');
require_once('../model/BagDAO.class.php');
require_once('../model/FuncDAO.class.php');
require_once('../model/OrdemCargaDAO.class.php');
require_once('../model/SafraDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR {

    public function dadosBagCargaEstoqueCod($info) {

        $bagDAO = new BagDAO();

        $dados = array("dados"=>$bagDAO->dadosCargaEstoqueCod($info['dado']));
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function dadosBagCargaEstoqueNro($info) {

        $bagDAO = new BagDAO();

        $dados = array("dados"=>$bagDAO->dadosCargaEstoqueNro($info['dado']));
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function dadosBagCargaProducaoCod($info) {

        $bagDAO = new BagDAO();

        $dados = array("dados"=>$bagDAO->dadosCargaProducaoCod($info['dado']));
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function dadosBagCargaProducaoNro($info) {

        $bagDAO = new BagDAO();

        $dados = array("dados"=>$bagDAO->dadosCargaProducaoNro($info['dado']));
        $json_str = json_encode($dados);
        
        return $json_str;
        
    }
    
    public function dadosBagTransfCod($info) {

        $bagDAO = new BagDAO();
        
        $dados = $info['dado'];
        $array = explode("_",$dados);

        $dados = array("dados"=>$bagDAO->dadosTransfCod($array[0], $array[1]));
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function dadosBagTransfNro($info) {

        $bagDAO = new BagDAO();
        
        $dados = $info['dado'];
        $array = explode("_",$dados);

        $dados = array("dados"=>$bagDAO->dadosTransfNro($array[0], $array[1]));
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function dadosFunc($info) {

        $funcDAO = new FuncDAO();
        
        if($atualAplicCTR->verifToken($info)){
            
        	$dados = array("dados"=>$funcDAO->dados());
        	$json_str = json_encode($dados);

        	return $json_str;
                
        }

    }
    
    public function dadosOrdemCarga($info) {

        $atualOrdemCargaDAO = new AtualOrdemCargaDAO();
        $ordemCargaDAO = new OrdemCargaDAO();
        
        if($atualAplicCTR->verifToken($info)){
            
        	$atualOrdemCargaDAO->atualOrdemCarga();
        	$dados = array("dados"=>$ordemCargaDAO->dados());
        	$json_str = json_encode($dados);

        	return $json_str;
                
        }

    }
    
    public function dadosSafra($info) {

        $safraDAO = new SafraDAO();
        
        if($atualAplicCTR->verifToken($info)){
            
        	$dados = array("dados"=>$safraDAO->dados());
        	$json_str = json_encode($dados);

        	return $json_str;
                        
        }

    }
    
}
