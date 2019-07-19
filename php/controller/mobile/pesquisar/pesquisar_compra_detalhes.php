<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 16-06-2019
 * Time: 03:13
 */

include_once ("../../../dao/pesquisa.php");

$compra_id = $_REQUEST["compra_id"];


$compras = select("c_compra c,ce_compra_estado ce","*","WHERE c.c_id = '$compra_id' AND c.ce_id = ce.ce_id");

$mensagem = array();

if($compras){

    $count = count($compras);
    $motorista = $compras[0]["ce_motorista"];
    $cliente_id = $compras[0]["u_id"];
    $dadosUser = select("u_utilizador","u_nome,u_email,u_contacto,u_email,u_id,u_endereco","WHERE u_id = '$cliente_id'");

    $localizacaoCliente = select("ml_motorista_localizacao,l_localizacao","*",
        "WHERE u_id = '$cliente_id' AND l_localizacao.l_id = ml_motorista_localizacao.l_id ORDER BY ml_id DESC");

    if(strcmp($compras[0]["ce_estado"],"a_caminho") == 0){



        $localizacao = select("ml_motorista_localizacao,l_localizacao","*",
            "WHERE u_id = '$motorista' AND l_localizacao.l_id = ml_motorista_localizacao.l_id ORDER BY ml_id DESC");



        if($localizacao){

            $mensagem[] = array(
                'erro'=>false,
                'id'=>$compras[0]["c_id"],
                'nome'=>$compras[0]["c_nome"],
                'data'=>date("d-M-Y", strtotime($compras[0]["c_data_criacao"])),
                'estado'=>"A Caminho",
                'motorista'=>$motorista,
                'latitude'=>$localizacao[0]["l_latitude"],
                'longitude'=>$localizacao[0]["l_longitude"],
                'latitude_cliente'=>$localizacaoCliente[0]["l_latitude"],
                'longitude_cliente'=>$localizacaoCliente[0]["l_longitude"],
                'tempo_chegada'=>"A calcular",
                'valor_total'=>number_format(somaProdutos($compras[0]["c_id"]),2,'.',','),
                'dadosUser'=>$dadosUser[0],
                'listaProdutos'=>listaProdutos($compras[0]["c_id"]),
                 'listaProdutos2'=>array('Data'=>listaProdutos($compras[0]["c_id"]))


            );
        }

    }else{

        $localizacao = select("ml_motorista_localizacao,l_localizacao","*",
            "WHERE u_id = '$motorista' AND l_localizacao.l_id = ml_motorista_localizacao.l_id ORDER BY ml_id DESC");

        $mensagem[] = array(
            'erro'=>false,
            'id'=>$compras[0]["c_id"],
            'nome'=>$compras[0]["c_nome"],
            'data'=>date("d-M-Y", strtotime($compras[0]["c_data_criacao"])),
            'estado'=>$compras[0]["ce_estado"],
            'motorista'=>$motorista,
            'latitude'=>$localizacao[0]["l_latitude"]."",
            'longitude'=>$localizacao[0]["l_longitude"]."",
            'latitude_cliente'=>$localizacaoCliente[0]["l_latitude"],
            'longitude_cliente'=>$localizacaoCliente[0]["l_longitude"],
            'tempo_chegada'=>"Não Aplicável",
            'valor_total'=>number_format(somaProdutos($compras[0]["c_id"]),2,'.',','),
            'dadosUser'=>$dadosUser[0],
            'listaProdutos2'=>array('Data'=>listaProdutos($compras[0]["c_id"]))

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