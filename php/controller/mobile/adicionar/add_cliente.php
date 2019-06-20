<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 16-06-2019
 * Time: 03:13
 */

include_once ("../../../dao/pesquisa.php");
include_once ("../../../dao/adicionar.php");


    $nome = $_REQUEST["nome"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $contacto = $_REQUEST["contacto"];
    $endereco = $_REQUEST["endereco"];

    $data_criacao = date("Y/m/d H:i:s");


$cliente = select("u_utilizador","*","WHERE u_email = '$email'");

if($cliente){

    $mensagem = array(
        'erro' => true,
        'mensagem' => 'Utilizador Existente'
    );

    echo json_encode($mensagem);

}else {

    $addCliente = adicionar(array("u_nome", "u_email", "u_senha", "u_grupo", "u_estado", "u_contacto", "u_endereco", "u_data_criacao"),
        array($nome, $email, md5($password), 2, 1, $contacto,$endereco, $data_criacao), "u_utilizador");

    if ($addCliente) {


        $mensagem = array(
            'erro' => false,
            'mensagem' => 'sucesso'

        );

        echo json_encode($mensagem);

    } else {

        $mensagem = array(
            'erro' => true,
            'mensagem' => 'Falha ao Adicionar Cliente'
        );

        echo json_encode($mensagem);

    }
}
