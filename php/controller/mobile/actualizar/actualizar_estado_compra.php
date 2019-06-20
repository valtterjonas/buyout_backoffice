<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 16-06-2019
 * Time: 03:13
 */

include_once ("../../../dao/pesquisa.php");
include_once ("../../../dao/actualizar.php");

$compra_id = $_REQUEST["compra_id"];
$estado = $_REQUEST["estado"];


$ce_estado = select("c_compra","ce_id","WHERE c_id = '$compra_id'");

if($ce_estado){

    $ce_id = $ce_estado[0]["ce_id"];

    $actualizar = atualizar("ce_estado",$estado,"ce_compra_estado","WHERE ce_id = '$ce_id'");

    if($actualizar){

        $mensagem[] = array(
            'erro'=>false,
            'mensagem'=>'sucesso',
        );

        echo json_encode(array('Data' => $mensagem));

    }else{

        $mensagem[] = array(
            'erro'=>true,
            'mensagem'=>"Falha ao Actualizar Compra"
        );

        echo json_encode(array('Data' => $mensagem));

    }


}


