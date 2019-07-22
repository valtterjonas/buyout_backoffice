<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 20-07-2019
 * Time: 18:51
 */



date_default_timezone_set("Africa/Maputo");

include_once ("../../dao/actualizar.php");
include_once ("../../dao/pesquisa.php");
include_once ("../../dao/apagar.php");


if(true){

    $p_id = $_REQUEST["p_id"];
    $p_nome = $_REQUEST["p_nome"];
    $p_preco = $_REQUEST["p_preco"];
    $p_descricao = $_REQUEST["p_descricao"];
    $p_ultimo_preco = $_REQUEST["p_ultimo_preco"];
    $p_desconto = $_REQUEST["p_desconto"];
    $p_estado = $_REQUEST["p_estado"];
    $p_subcategoria = $_REQUEST["p_subcategoria"];



        $actProduto = atualizar(array("p_nome","p_descricao","p_preco","p_ultimo_preco","p_desconto","p_estado","s_id"),
            array($p_nome,$p_descricao,$p_preco,$p_ultimo_preco,$p_desconto,$p_estado,$p_subcategoria), "p_produto",
            "WHERE p_id = '$p_id'");


        if($actProduto){



            $mensagem = array(
                'estado'=>'sucesso'
            );
            echo json_encode($mensagem);


        }else{

            $mensagem = array(
                'estado'=>'erro'
            );
            echo json_encode($mensagem);

        }

}else{


    $status = array(
        'estado'=>'login'
    );

    echo json_encode($status);


}


