<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 16-06-2019
 * Time: 03:13
 */

include_once ("../../../dao/pesquisa.php");

$categoria = select("c_categoria","*","ORDER BY c_id DESC");

$mensagem = array();

if($categoria){

    $count = count($categoria);
    for($i = 0; $i<$count; $i++){

        $mensagem[] = array(
            'erro'=>false,
            'id'=>$categoria[$i]["c_id"],
            'nome'=>$categoria[$i]["c_nome"],
            'descricao'=>$categoria[$i]["c_descricao"],
            'imagem'=>$categoria[$i]["c_imagem"]

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