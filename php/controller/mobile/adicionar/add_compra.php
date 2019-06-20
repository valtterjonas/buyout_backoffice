<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 16-06-2019
 * Time: 03:13
 */

include_once ("../../../dao/pesquisa.php");
include_once ("../../../dao/adicionar.php");


$u_id = $_REQUEST["u_id"];
$lista_produtos = $_REQUEST["produtos"];
$produtos = json_decode($lista_produtos);
$data_criacao = date("Y/m/d H:i:s");
$compraNome = rand(100,10000)."_compra";


$addCompraEstado = adicionar(array("ce_estado","ce_data_criacao"),array("pendente",$data_criacao),"ce_compra_estado");

if($addCompraEstado){

    $max_ce_id = select("ce_compra_estado","MAX(ce_id) AS 'id'")[0]["id"];


    $addCompra = adicionar(array("c_nome","ce_id","c_data_criacao","u_id"),array($compraNome,$max_ce_id,$data_criacao,$u_id),"c_compra");

    if($addCompra){

        $max_c_id = select("c_compra","MAX(c_id) AS 'id'")[0]["id"];

        foreach($produtos as $obj){

            $id = $obj->id;
            $nome = $obj->nome;
            $quantidade = $obj->quantidade;

            $addCompraProduto = adicionar(array("c_id","p_id","cp_quantidade","cp_data_criacao"),array($max_c_id,$id,$quantidade,$data_criacao),"cp_compra_produto");

        }

        if($addCompraProduto){

            $mensagem = array(
              'erro'=>false,
               'mensagem'=>'sucesso',
               'compra_id'=> $max_c_id,
               'compra_estado'=> 'pendente'
            );

            echo json_encode($mensagem);

        }else{

            $mensagem = array(
                'erro'=>true,
                'mensagem'=>'Falha ao Adicionar Produtos'
            );

            echo json_encode($mensagem);

        }
    }else{

        $mensagem = array(
            'erro'=>true,
            'mensagem'=>'Falha ao Adicionar Compra'
        );

        echo json_encode($mensagem);


    }

}else{
    $mensagem = array(
        'erro'=>true,
        'mensagem'=>'Falha ao Adicionar Estado da Compra'
    );

    echo json_encode($mensagem);
}
