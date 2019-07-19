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

//$compra_id = "20";
//$estado = "entregue";
//$latitude = "-25.9522728";
//$longitude = "32.5889291";
//$motorista_id = "11";


$addLocalizacao = adicionar(array("l_latitude","l_longitude","l_data_criacao"),array($latitude,$longitude,$data_criacao),"l_localizacao");

if($addLocalizacao) {

    $max_l_id = select("l_localizacao", "MAX(l_id) AS 'id'")[0]["id"];

    $addLocalizacaoMotorista = adicionar(array("l_id", "u_id", "ml_data_criacao"), array($max_l_id, $motorista_id, $data_criacao), "ml_motorista_localizacao");

    if ($addLocalizacaoMotorista) {

        $ce_estado = select("c_compra", "ce_id,u_id", "WHERE c_id = '$compra_id'");

        if ($ce_estado) {

            $ce_id = $ce_estado[0]["ce_id"];
            $u_id = $ce_estado[0]["u_id"];

            $actualizar = atualizar(array("ce_estado", "ce_motorista"), array($estado, $motorista_id), "ce_compra_estado", "WHERE ce_id = '$ce_id'");

            if ($actualizar) {


                if(strcmp($estado,"entregue") == 0){

                    $tokens2 = select("md_mobile_device","md_token","WHERE id_utilizador = '$u_id' ORDER BY md_id DESC LIMIT 1");

                    $tokens = array();

                    for($i = 0; $i<count($tokens2); $i++){
                        $tokens[] = $tokens2[$i]["md_token"];
                    }

                    $message = array
                    (
                        'message' 	=> "Buyout",
                        'title'		=> "Aceitar entrega de produtos",
                        'subtitle'	=> "Pressione Aceitar",
                        'compra_id'=> $compra_id,
                        'type' => 'driver_report',
                        'vibrate'	=> 1,
                        'sound'		=> 1
                    );

                    $message_status = send_notification($tokens, $message);

                }

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

function send_notification ($tokens, $message)
{
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
        'registration_ids' => $tokens,
        'data' => $message
    );
    $headers = array(
        'Authorization:key = AAAA8XvVWqo:APA91bH_XpAi7MxxETwv4imdTvdnlW5Ri4n6GPgDr6twZAWZ3sft9b7Yq8XVk5Itrlo-f34HbZDeoLmbuj9CA7SdKtW0V9Gp_ukxIUFaXB5oY9KZfKpOCo1Ewnv_gCV80FHJcqooWmp-',
        'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}
