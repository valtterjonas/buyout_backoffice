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


function listarCategoria(){

        $categorias = select("c_categoria", "*","ORDER BY c_id DESC");


        $resposta = "";

        if ($categorias) {



            for ($i = 0; $i < count($categorias); $i++) {

                $c_id = $categorias[$i]["c_id"];
                $c_nome = $categorias[$i]["c_nome"];
                $c_descricao = $categorias[$i]["c_descricao"];
                $c_imagem = $categorias[$i]["c_imagem"];


                $resposta .= '
                			 <tr>
                                                <td>'.$c_id.'</td>
                                                <td>'.$c_nome.'</td>
                                                <td>'.$c_descricao.'</td>
                                                <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-id="'.$c_imagem.'" data-target="#imagemModal"> Ver Imagem</button></td>

                                            
                                            </tr>
                ';

            }

            echo $resposta;


        }

    }
function listarCategoriaSelect(){

        $categorias = select("c_categoria", "*","ORDER BY c_id DESC");


        $resposta = "";

        if ($categorias) {



            for ($i = 0; $i < count($categorias); $i++) {

                $c_id = $categorias[$i]["c_id"];
                $c_nome = $categorias[$i]["c_nome"];


                $resposta .= '
                			 <option value="'.$c_id.'">'.$c_nome.'</option>
                ';

            }

            echo $resposta;


        }

    }
