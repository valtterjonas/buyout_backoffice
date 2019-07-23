<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 16-06-2019
 * Time: 03:13
 */

date_default_timezone_set("Africa/Maputo");

include_once ("../../../dao/pesquisa.php");
include_once ("../../../dao/adicionar.php");


$u_id = $_REQUEST["u_id"];
$lista_produtos = $_REQUEST["produtos"];
$latitude = $_REQUEST["latitude"];
$longitude = $_REQUEST["longitude"];
$preco_total = $_REQUEST["preco_total"];
$produtos = json_decode($lista_produtos);
$data_criacao = date("Y/m/d H:i:s");
$compraNome = rand(100,10000)."_compra";


$addCompraEstado = adicionar(array("ce_estado","ce_data_criacao"),array("pendente",$data_criacao),"ce_compra_estado");

if($addCompraEstado){

    $max_ce_id = select("ce_compra_estado","MAX(ce_id) AS 'id'")[0]["id"];


    $addCompra = adicionar(array("c_nome","ce_id","c_data_criacao","u_id","c_preco_total"),array($compraNome,$max_ce_id,$data_criacao,$u_id,$preco_total),"c_compra");

    $addLocalizacao = adicionar(array("l_latitude","l_longitude","l_data_criacao"),array($latitude,$longitude,$data_criacao),"l_localizacao");

    $max_l_id = select("l_localizacao", "MAX(l_id) AS 'id'")[0]["id"];

    $addLocalizacaoMotorista = adicionar(array("l_id", "u_id", "ml_data_criacao"), array($max_l_id, $u_id, $data_criacao), "ml_motorista_localizacao");


    if($addCompra){

        $max_c_id = select("c_compra","MAX(c_id) AS 'id'")[0]["id"];

        foreach($produtos as $obj){

            $id = $obj->id;
            $nome = $obj->nome;
            $quantidade = $obj->quantidade;

            $addCompraProduto = adicionar(array("c_id","p_id","cp_quantidade","cp_data_criacao"),array($max_c_id,$id,$quantidade,$data_criacao),"cp_compra_produto");

        }

        if($addCompraProduto){


            $tokens2 = select("md_mobile_device","md_token,id_utilizador");

            $tokens = array();

            for($i = 0; $i<count($tokens2); $i++){

                $driver = $tokens2[$i]["id_utilizador"];

                $isDriver = select("u_utilizador","u_grupo","WHERE u_id = '$driver'");


                if($isDriver[0]["u_grupo"] == 3){

                   // echo "Im in";

                    $tokens[] = $tokens2[$i]["md_token"];

                }

            }

            $message = array
            (
                'message' 	=> "Buyout",
                'title'		=> "Existe uma nova compra",
                'subtitle'	=> "Pressione para ver",
                'compra_id'=> $max_c_id,
                'type' => 'nova_compra',
                'vibrate'	=> 1,
                'sound'		=> 1
            );

            $message_status = send_notification($tokens, $message);


            $mensagem = array(
              'erro'=>false,
               'mensagem'=>'sucesso',
               'compra_id'=> $max_c_id,
               'compra_estado'=> 'pendente'
            );

            echo json_encode($mensagem);

        }else{

            $mensagem = array(
                'erro'=>true,
                'mensagem'=>'Falha ao Adicionar Produtos'
            );

            echo json_encode($mensagem);

        }
    }else{

        $mensagem = array(
            'erro'=>true,
            'mensagem'=>'Falha ao Adicionar Compra'
        );

        echo json_encode($mensagem);


    }

}else{
    $mensagem = array(
        'erro'=>true,
        'mensagem'=>'Falha ao Adicionar Estado da Compra'
    );

    echo json_encode($mensagem);
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
