<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 16-06-2019
 * Time: 03:14
 */

date_default_timezone_set("Africa/Maputo");

include_once ("../../../dao/pesquisa.php");


$subcategoria = $_REQUEST["subcategoria_id"];

$produtos = select("p_produto","*","WHERE s_id = '$subcategoria' AND p_estado LIKE 'activo' ORDER BY p_id DESC");

        if($produtos){

            $count = count($produtos);

            for($i = 0; $i<$count; $i++){

            $mensagem[] = array(
                'erro'=>false,
                'id'=>$produtos[$i]["p_id"],
                'nome'=>$produtos[$i]["p_nome"],
                'preco'=>number_format($produtos[$i]["p_preco"],2,'.',','),
                'desconto'=>$produtos[$i]["p_desconto"],
                'descricao'=>$produtos[$i]["p_descricao"],
                'imagem'=>$produtos[$i]["p_imagem"]

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