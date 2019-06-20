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


function listarSubCategoria(){



        $subcategorias = select("s_subcategoria,c_categoria", "*","WHERE c_categoria.c_id = s_subcategoria.c_id ORDER BY s_subcategoria.s_id DESC");


        $resposta = "";

        if ($subcategorias) {



            for ($i = 0; $i < count($subcategorias); $i++) {

                $s_id = $subcategorias[$i]["s_id"];
                $s_nome = $subcategorias[$i]["s_nome"];
                $s_descricao = $subcategorias[$i]["s_descricao"];
                $c_categoria = $subcategorias[$i]["c_nome"];
                $s_imagem = $subcategorias[$i]["s_imagem"];


                $resposta .= '
                			 <tr>
                                                <td>'.$s_id.'</td>
                                                <td>'.$s_nome.'</td>
                                                <td>'.$s_descricao.'</td>
                                                <td>'.$c_categoria.'</td>
                                                <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-id="'.$s_imagem.'" data-target="#imagemModal"> Ver Imagem</button></td>
                                            
                                            </tr>
                ';

            }

            echo $resposta;


        }

    }
function listarSubCategoriaSelect(){



        $subcategorias = select("s_subcategoria,c_categoria", "*","WHERE c_categoria.c_id = s_subcategoria.c_id ORDER BY s_subcategoria.s_id DESC");


        $resposta = "";

        if ($subcategorias) {



            for ($i = 0; $i < count($subcategorias); $i++) {

                $s_id = $subcategorias[$i]["s_id"];
                $s_nome = $subcategorias[$i]["s_nome"];
                $s_descricao = $subcategorias[$i]["s_descricao"];
                $c_categoria = $subcategorias[$i]["c_nome"];


                $resposta .= '
                			 <option value="'.$s_id.'">'.$s_nome.'</option>
                ';

            }

            echo $resposta;


        }

    }
