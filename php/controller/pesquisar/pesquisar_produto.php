<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 14-01-2019
 * Time: 14:03
 */

include_once("php/dao/pesquisa.php");
include_once("php/dao/adicionar.php");

date_default_timezone_set("Africa/Maputo");

$data_actual = date("Y-m-d H:i:s");


    function listarProdutos()
    {

        $produtos = select("p_produto,s_subcategoria", "*", "WHERE p_produto.s_id = s_subcategoria.s_id ORDER BY p_id DESC");


        $resposta = "";

        if ($produtos) {


            for ($i = 0; $i < count($produtos); $i++) {

                $p_id = $produtos[$i]["p_id"];
                $p_nome = $produtos[$i]["p_nome"];
                $p_descricao = $produtos[$i]["p_descricao"];
                $p_preco = $produtos[$i]["p_preco"];
                $p_ultimo_preco = $produtos[$i]["p_ultimo_preco"];
                $p_desconto = $produtos[$i]["p_desconto"];
                $p_data_criacao = $produtos[$i]["p_data_criacao"];
                $p_imagem = $produtos[$i]["p_imagem"];
                $p_estado = $produtos[$i]["p_estado"];
                $s_id = $produtos[$i]["s_nome"];


                $resposta .= '
                			 <tr>
                                                <td>' . $p_id . '</td>
                                                <td>' . $p_nome . '</td>
                                                <td>' . $p_descricao . '</td>
                                                <td>' . $p_preco . '</td>
                                                <td>' . $p_ultimo_preco . '</td>
                                                <td>' . $p_desconto . '</td>
                                                <td>' . $s_id . '</td>
                                                <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-produto="'.$p_id.'" data-id="'.$p_imagem.'" data-target="#imagemModal"> Ver Imagem</button></td>
                                                <td>' . $p_data_criacao . '</td>
                                                <td> <a href="#" onclick="goToEditar('.$p_id.')"> Editar <i class="fa fa-edit"></i> </a> </td>
                                            </tr>
                ';

            }

            echo $resposta;


        } else {

            $status = array(
                'estado' => 'login'
            );

            echo json_encode($status);

        }
    }


