<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 14-01-2019
 * Time: 14:03
 */

include_once("../../dao/pesquisa.php");
include_once("../../dao/adicionar.php");

date_default_timezone_set("Africa/Maputo");

$data_actual = date("Y-m-d H:i:s");

    $produto_id = $_REQUEST["p_id"];

    listarUnicoProduto($produto_id);




    function listarUnicoProduto($p_id)
    {

        $produtos = select("p_produto,s_subcategoria", "*", "WHERE p_produto.p_id = '$p_id' AND p_produto.s_id = s_subcategoria.s_id ORDER BY p_id DESC");


        if ($produtos) {

            $status = array(
                'estado'=>'sucesso',
                'data'=>$produtos
            );

            echo json_encode($status);


        } else {

            $status = array(
                'estado' => 'erro'
            );

            echo json_encode($status);

        }
    }


