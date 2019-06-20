<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 16-06-2019
 * Time: 03:13
 */

include_once ("../../../dao/pesquisa.php");

$categoria = select("s_subcategoria","*","ORDER BY s_id DESC");

$mensagem = array();

if($categoria){

    $count = count($categoria);
    for($i = 0; $i<$count; $i++){

        $mensagem[] = array(
            'erro'=>false,
            'id'=>$categoria[$i]["s_id"],
            'nome'=>$categoria[$i]["s_nome"],
            'descricao'=>$categoria[$i]["s_descricao"],
            'imagem'=>"".$categoria[$i]["s_imagem"],

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