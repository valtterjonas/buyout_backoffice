<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 16-06-2019
 * Time: 03:13
 */

include_once ("../../../dao/adicionar.php");
include_once ("../../../dao/pesquisa.php");
include_once ("../../../dao/actualizar.php");

$compra_id = $_REQUEST["compra_id"];
$estado = $_REQUEST["estado"];
$latitude = $_REQUEST["latitude"];
$longitude = $_REQUEST["longitude"];
$motorista_id = $_REQUEST["motorista_id"];
$data_criacao = date("Y/m/d H:i:s");



$addLocalizacao = adicionar(array("l_latitude","l_longitude","l_data_criacao"),array($latitude,$longitude,$data_criacao),"l_localizacao");

if($addLocalizacao) {

    $max_l_id = select("l_localizacao", "MAX(l_id) AS 'id'")[0]["id"];

    $addLocalizacaoMotorista = adicionar(array("l_id", "u_id", "ml_data_criacao"), array($max_l_id, $motorista_id, $data_criacao), "ml_motorista_localizacao");

    if ($addLocalizacaoMotorista) {

        $ce_estado = select("c_compra", "ce_id", "WHERE c_id = '$compra_id'");

        if ($ce_estado) {

            $ce_id = $ce_estado[0]["ce_id"];

            $actualizar = atualizar(array("ce_estado", "ce_motorista"), array($estado, $motorista_id), "ce_compra_estado", "WHERE ce_id = '$ce_id'");

            if ($actualizar) {

                $mensagem[] = array(
                    'erro' => false,
                    'mensagem' => 'sucesso',
                );

                echo json_encode(array('Data' => $mensagem));

            } else {

                $mensagem[] = array(
                    'erro' => true,
                    'mensagem' => "Falha ao Actualizar Compra"
                );

                echo json_encode(array('Data' => $mensagem));

            }


        }else{
            $mensagem[] = array(
                'erro' => true,
                'mensagem' => "Falha ao Procurar a compra"
            );

            echo json_encode(array('Data' => $mensagem));
        }

    }else{

        $mensagem[] = array(
            'erro' => true,
            'mensagem' => "Falha ao Adicionar Localizacao do Motorista"
        );

        echo json_encode(array('Data' => $mensagem));

    }
}else{
    $mensagem[] = array(
        'erro' => true,
        'mensagem' => "Falha ao Adicionar Localizacao"
    );

    echo json_encode(array('Data' => $mensagem));
}


