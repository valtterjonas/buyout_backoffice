<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 07-06-2019
 * Time: 00:19
 */




include_once("php/dao/pesquisa.php");
include_once("php/dao/adicionar.php");

date_default_timezone_set("Africa/Maputo");

$data_actual = date("Y-m-d H:i:s");


    function motoristasLocalizacao(){

        $motoristas = select("u_utilizador", "*","WHERE u_grupo = 3 ORDER BY u_id DESC");



        $resposta = "";

        if ($motoristas) {



            for ($i = 0; $i < count($motoristas); $i++) {

                $u_id = $motoristas[$i]["u_id"];

                $localizacao = select("ml_motorista_localizacao ml, l_localizacao l","l.l_latitude,l.l_longitude",
                    "WHERE l.l_id = ml.l_id AND ml.u_id = '$u_id' ORDER BY l.l_id DESC");

                $u_nome = $motoristas[$i]["u_nome"];
                $u_email = $motoristas[$i]["u_email"];
                $u_contacto = $motoristas[$i]["u_contacto"];
                $u_endereco = $motoristas[$i]["u_endereco"];
                $u_data_criacao = $motoristas[$i]["u_data_criacao"];
                $latitude = $localizacao[0]["l_latitude"];
                $longitude = $localizacao[0]["l_longitude"];



                $resposta .= '
                			 <tr>
                                                <td>'.$u_id.'</td>
                                                <td>'.$u_nome.'</td>
                                                <td>'.$u_email.'</td>
                                                <td>'.$u_contacto.'</td>
                                                <td>'.$u_endereco.'</td>
                                                <td><a class="btn btn-primary" href="ultima_localizacao.php?token='.$u_id.'&nome='.$u_nome.'&latitude='.$latitude.'&longitude='.$longitude.'"> Última Localização </a></td>
                                                <td>'.$u_data_criacao.'</td>
                                            
                                            </tr>
                ';

            }

            echo $resposta;


        }


    }
