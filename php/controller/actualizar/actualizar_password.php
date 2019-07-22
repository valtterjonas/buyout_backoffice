<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 20-07-2019
 * Time: 21:11
 */


date_default_timezone_set("Africa/Maputo");

include_once ("../../dao/actualizar.php");
include_once ("../../dao/pesquisa.php");


$u_id = $_REQUEST["u_id"];
$u_senha = $_REQUEST["u_senha"];


    $actUtilizador = atualizar("u_senha",md5($u_senha),"u_utilizador","WHERE u_id = '$u_id'");


    if($actUtilizador){

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




