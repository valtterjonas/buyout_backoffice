<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 16-12-2018
 * Time: 14:26
 */


date_default_timezone_set("Africa/Maputo");

include_once ("../../dao/adicionar.php");
include_once ("../../dao/pesquisa.php");


$u_nome = $_REQUEST["u_nome"];
$u_email = $_REQUEST["u_email"];
$u_senha = $_REQUEST["u_senha"];
$u_grupo = $_REQUEST["u_grupo"];
$u_senha = md5($u_senha);
$u_contacto = $_REQUEST["u_contacto"];
$u_endereco = $_REQUEST["u_endereco"];
$data_criacao = date("Y/m/d H:i:s");
$estado = "activo";
$u_cod_confirmacao = rand(1000,9000);
// $u_cod_confirmacao = md5($u_cod_confirmacao);

$get_user = select("u_utilizador","u_id","WHERE u_email LIKE '$u_email'");


    if(!$get_user){


        $addUtilizador = adicionar(array("u_nome","u_email","u_senha","u_grupo","u_estado","u_contacto","u_endereco","u_data_criacao"),
                array($u_nome,$u_email,$u_senha,intval($u_grupo),$estado,$u_contacto,$u_endereco,$data_criacao), "u_utilizador");


            if($addUtilizador){

                $mensagem = array(
                    'estado'=>'sucesso',
                    'email'=>$u_email." ".$u_grupo
                );
                echo json_encode($mensagem);

               /* $get_link = select("c_configs","c_valor","WHERE c_tipo LIKE 'link_utilizador'");

                $subject = "Confirmacao de email";
                $link = $get_link[0]["c_valor"]."confirmar_utilizador.html?token=".md5($u_email);
                $body = "Saudacoes ".$u_nome."!!!<br>Entre no link abaixo para confirmar a sua conta na You & You.<br>".$link."<br> <br>Equipe do You&You";
                $from = "noreply@youandyoubox.com";

                if(enviarEmail($u_email,$body,$subject,$from,"you&you")){

                    $mensagem = array(
                        'estado'=>'sucesso',
                        'email'=>$u_email
                    );
                    echo json_encode($mensagem);


                }else{

                    $mensagem = array(
                        'estado'=>'email'.$mail
                    );
                    echo json_encode($mensagem);


                }

               */

            }else{


                $mensagem = array(
                    'estado'=>'erro'
                );
                echo json_encode($mensagem);


            }


    }else{


        $status = array(
            'estado'=>'existe'
        );

        echo json_encode($status);


    }



function send_mail($to, $subject, $body, $from) {

    // This will provide plenty adequate entropy
    $multipartSep = '-----'.md5(time()).'-----';

    // Arrays are much more readable
    $headers = array(
        "From: $from",
        "Reply-To: $from",
        "Content-Type: multipart/mixed; boundary=\"$multipartSep\""
    );


    // Make the body of the message
    $body = "--$multipartSep\r\n"
        . "Content-Type: text/plain; charset=UTF-8; format=flowed\r\n"
        . "Content-Transfer-Encoding: 7bit\r\n"
        . "\r\n"
        . "$body\r\n"
        . "--$multipartSep\r\n";


    // Send the email, return the result
    return @mail($to, $subject, $body, implode("\r\n", $headers));

}
