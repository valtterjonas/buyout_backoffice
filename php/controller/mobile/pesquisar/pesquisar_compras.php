<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 16-06-2019
 * Time: 03:13
 */

include_once ("../../../dao/pesquisa.php");

$utilizador = $_REQUEST["u_id"];
$estado = $_REQUEST["estado"];

if(isset($_REQUEST["u_id"])){

    if(strcmp($estado,"pendente") == 0){

        $estado = "entregue";

        $compras = select("c_compra c,ce_compra_estado ce","*","WHERE c.u_id = '$utilizador' AND ce.ce_estado NOT LIKE '$estado' AND ce.ce_id = c.ce_id ORDER BY c.c_id DESC");

    }else{

        $compras = select("c_compra c,ce_compra_estado ce","*","WHERE c.u_id = '$utilizador' AND ce.ce_estado LIKE '$estado' AND ce.ce_id = c.ce_id ORDER BY c.c_id DESC");

    }
}else {


        $compras = select("c_compra c,ce_compra_estado ce", "*", "WHERE ce.ce_estado LIKE '$estado' AND ce.ce_id = c.ce_id ORDER BY c.c_id DESC");

}

$mensagem = array();

if($compras){

    $count = count($compras);
    for($i = 0; $i<$count; $i++){

        $mensagem[] = array(
            'erro'=>false,
            'id'=>$compras[$i]["c_id"],
            'nome'=>$compras[$i]["c_nome"],
            'data'=>date("d-M-Y", strtotime($compras[$i]["c_data_criacao"])),
            'estado'=>$estado,
            'valor_total'=>number_format(somaProdutos($compras[$i]["c_id"]),2,'.',',')
        );

    }
    echo json_encode(array('Data' => $mensagem));

}else{

    $mensagem[] = array(
        'erro'=>true,
        'mensagem'=>"Falha ao Pesquisar Categoria"
    );

    echo json_encode(array('Data' => $mensagem));

}

function somaProdutos($compra_id){

    $produtos = select("cp_compra_produto cp","p_id, cp_quantidade","WHERE cp.c_id = '$compra_id'");

    $total = 0.0;

    for($i=0;$i<count($produtos);$i++){
        $p_id = $produtos[$i]["p_id"];
        $produtos_preco = select("p_produto p","p_preco","WHERE p_id = '$p_id'");
        $total = $total + ($produtos[$i]["cp_quantidade"] * $produtos_preco[0]["p_preco"]);

    }

    return $total;

}