<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 16-06-2019
 * Time: 03:13
 */

include_once ("php/dao/pesquisa.php");



function listarCompras()
{
    $compras = select("c_compra c,ce_compra_estado ce", "*", "WHERE c.ce_id = ce.ce_id ORDER BY c.c_id DESC");

    $mensagem = array();

    if ($compras) {
        $tabela = "";
        $count = count($compras);
        for ($i = 0; $i < $count; $i++) {
            $compra_nome = $compras[$i]["c_nome"];
            $motorista = $compras[$i]["ce_motorista"];
            $cliente_id = $compras[$i]["u_id"];
            $dadosUser = select("u_utilizador", "u_nome,u_email,u_contacto,u_email,u_id,u_endereco", "WHERE u_id = '$cliente_id'");


            if (strcmp($compras[$i]["ce_estado"], "a_caminho") == 0) {


                $localizacao = select("ml_motorista_localizacao,l_localizacao", "*",
                    "WHERE u_id = '$motorista' AND l_localizacao.l_id = ml_motorista_localizacao.l_id ORDER BY ml_id DESC");

                if ($localizacao) {

                    $mensagem[] = array(
                        'erro' => false,
                        'id' => $compras[$i]["c_id"],
                        'nome' => $compras[$i]["c_nome"],
                        'data' => date("d-M-Y", strtotime($compras[$i]["c_data_criacao"])),
                        'estado' => "A Caminho",
                        'motorista' => $motorista,
                        'latitude' => $localizacao[0]["l_latitude"],
                        'longitude' => $localizacao[0]["l_longitude"],
                        'tempo_chegada' => "A calcular",
                        'valor_total' => number_format(somaProdutos($compras[$i]["c_id"]), 2, '.', ','),
                        'dadosUser' => $dadosUser[0],
                        'listaProdutos' => listaProdutos($compras[$i]["c_id"])

                    );
                }

            } else {

                $mensagem[] = array(
                    'erro' => false,
                    'id' => $compras[$i]["c_id"],
                    'nome' => $compras[$i]["c_nome"],
                    'data' => date("d-M-Y", strtotime($compras[$i]["c_data_criacao"])),
                    'estado' => $compras[$i]["ce_estado"],
                    'motorista' => $motorista,
                    'tempo_chegada' => "Não Aplicável",
                    'valor_total' => number_format(somaProdutos($compras[$i]["c_id"]), 2, '.', ','),
                    'dadosUser' => $dadosUser[0],
                    'listaProdutos' => array('Data' => listaProdutos($compras[$i]["c_id"]))

                );

            }

            $tabela .= '
                                             <tr>
                                                <td>' . $compras[$i]["c_id"] . '</td>
                                                <td>' . $compras[$i]["c_data_criacao"] . '</td>
                                                <td>' . $dadosUser[0]["u_nome"] . '</td>
                                                <td>' . $compras[$i]["ce_estado"] . '</td>
                                                <td>' . $motorista . '</td>
                                                <td>' . count(listaProdutos($compras[$i]["c_id"])) . '</td>
                                                <td> <a href="produto_compra.php?token='.$compras[$i]["c_id"].'" class="btn btn-primary"> Ver Produtos</a></td>
                                                <td>' . number_format(somaProdutos($compras[$i]["c_id"]), 2, '.', ',') . '</td>
                                            
                                             </tr>
                                  
                                             
            ';


        }


        echo $tabela;

    } else {

        $mensagem[] = array(
            'erro' => true,
            'mensagem' => "Falha ao Pesquisar Compras"
        );

        echo json_encode($mensagem);

    }

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