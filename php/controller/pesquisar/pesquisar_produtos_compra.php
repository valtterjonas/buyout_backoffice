<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 18-06-2019
 * Time: 12:23
 */

include_once ("../../dao/pesquisa.php");


echo json_encode(listaProdutos($_REQUEST["compra_id"]));


function listaProdutos($compra_id){

    $produtos = select("cp_compra_produto cp","p_id, cp_quantidade","WHERE cp.c_id = '$compra_id'");

    for($i=0;$i<count($produtos);$i++){
        $p_id = $produtos[$i]["p_id"];
        $produtos_preco = select("p_produto p","*","WHERE p_id = '$p_id'");

        $mensagem[] = array(
            'produto_id'=>$produtos_preco[0]["p_id"],
            'produto_nome'=>$produtos_preco[0]["p_nome"],
            'preco_unit'=>$produtos_preco[0]["p_preco"],
            'preco_total'=>number_format($produtos[$i]["cp_quantidade"] * $produtos_preco[0]["p_preco"],2,'.',','),
            'quantidade'=>$produtos[$i]["cp_quantidade"]
        );
    }

    return $mensagem;

}