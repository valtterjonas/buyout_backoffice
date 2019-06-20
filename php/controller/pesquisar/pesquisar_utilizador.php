<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 07-06-2019
 * Time: 01:00
 */




include_once("php/dao/pesquisa.php");
include_once("php/dao/adicionar.php");

date_default_timezone_set("Africa/Maputo");

$data_actual = date("Y-m-d H:i:s");


function listarUtilizador($tipo){


        $motoristas = select("u_utilizador", "*","WHERE u_grupo = '$tipo' ORDER BY u_id DESC");


        $resposta = "";

        if ($motoristas) {



            for ($i = 0; $i < count($motoristas); $i++) {

                $u_id = $motoristas[$i]["u_id"];
                $u_nome = $motoristas[$i]["u_nome"];
                $u_email = $motoristas[$i]["u_email"];
                $u_contacto = $motoristas[$i]["u_contacto"];
                $u_endereco = $motoristas[$i]["u_endereco"];
                $u_ultimo_login = $motoristas[$i]["u_ultimo_login"];
                $u_estado = $motoristas[$i]["u_estado"];
                $u_data_criacao = $motoristas[$i]["u_data_criacao"];



                $resposta .= '
                			 <tr>
                                                <td>'.$u_id.'</td>
                                                <td>'.$u_nome.'</td>
                                                <td>'.$u_email.'</td>
                                                <td>'.$u_contacto.'</td>
                                                <td>'.$u_endereco.'</td>
                                                <td>'.$u_ultimo_login.'</td>
                                                <td>'.$u_estado.'</td>
                                                <td>'.$u_data_criacao.'</td>
                                            
                                            </tr>
                ';

            }

            echo $resposta;


        }


    }
