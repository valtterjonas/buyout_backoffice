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

    $actualizar = atualizar("ce_estado_cliente",$estado,"ce_compra_estado","WHERE ce_id = '$ce_id'");
    $actualizar = atualizar("ce_estado",$estado,"ce_compra_estado","WHERE ce_id = '$ce_id'");


    if($actualizar){

        if(strcmp($estado,"entregue") == 0){

            $driver = select("ce_compra_estado","ce_motorista","WHERE ce_id = '$ce_id'")[0]["ce_motorista"];

            $tokens2 = select("md_mobile_device","md_token","WHERE id_utilizador = '$driver'");

            $tokens = array();

            for($i = 0; $i<count($tokens2); $i++){
                $tokens[] = $tokens2[$i]["md_token"];
            }

            $message = array
            (
                'message' 	=> "Buyout",
                'title'		=> "O cliente confirmou a recepção de produtos",
                'subtitle'	=> "Pressione Aceitar",
                'compra_id'=> $compra_id,
                'type' => 'client_report',
                'vibrate'	=> 1,
                'sound'		=> 1
            );

            $message_status = send_notification($tokens, $message);

        }

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


