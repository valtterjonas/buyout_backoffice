<?php
/**
 * Created by PhpStorm.
 * User: TechJonas
 * Date: 04/23/2018
 * Time: 12:35
 */

date_default_timezone_set("Africa/Maputo");


$token = $_REQUEST["token"];
$u_id = $_REQUEST["u_id"];


include_once ("../../../dao/adicionar.php");
include_once ("../../../dao/pesquisa.php");
include_once ("../../../dao/apagar.php");

$data_criacao = date("Y/m/d H:i:s");


$existe = select("md__mobile_device","*","WHERE id_utilizador LIKE '$u_id'");

if($existe){

    apagar("md_mia_mobile_devices","WHERE id_utilizador LIKE '$u_id'");

    $adicionarDevice = adicionar(array("md_token", "md_data_criacao","id_utilizador"),
        array($token,$data_criacao,$u_id), "md_mobile_device");

    if($adicionarDevice){
        $status = array(
            'estado'=>'sucesso'
        );

        echo json_encode($status);
    }else{
        $status = array(
            'estado'=>'erro'
        );

        echo json_encode($status);
    }

}else{
    $adicionarDevice = adicionar(array("md_token", "md_data_criacao","id_utilizador"),
        array($token,$data_criacao,$u_id), "md_mobile_device");

    if($adicionarDevice){
        $status = array(
            'estado'=>'sucesso'
        );

        echo json_encode($status);
    }else{
        $status = array(
            'estado'=>'erro'
        );

        echo json_encode($status);
    }
}




