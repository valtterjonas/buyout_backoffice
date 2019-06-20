<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 12-01-2019
 * Time: 10:27
 */



date_default_timezone_set("Africa/Maputo");

include_once ("../../dao/adicionar.php");
include_once ("../../dao/pesquisa.php");
include_once ("../../dao/apagar.php");


if(true){

    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
    $path = '../../../images/produtos/'; // upload directory


    $p_nome = $_REQUEST["p_nome"];
    $p_preco = $_REQUEST["p_preco"];
    $p_descricao = $_REQUEST["p_descricao"];
    $p_ultimo_preco = $_REQUEST["p_ultimo_preco"];
    $p_desconto = $_REQUEST["p_desconto"];
    $p_imagem = $_REQUEST["p_imagem"];
    $p_estado = $_REQUEST["p_estado"];
    $p_subcategoria = $_REQUEST["p_subcategoria"];


    $img = $_FILES['p_imagem']['name'];


    $tmp = $_FILES['p_imagem']['tmp_name'];


    $data_criacao = date("Y/m/d H:i:s");


    // can upload same image using rand function
    $final_image = rand(1000,1000000).$img;



    $path1 = $path.strtolower($final_image);


    if(move_uploaded_file($tmp,$path1)) {


    $addProduto = adicionar(array("p_nome","p_descricao","p_preco","p_ultimo_preco","p_desconto","p_data_criacao","p_imagem","p_estado","s_id"),
        array($p_nome,$p_descricao,$p_preco,$p_ultimo_preco,$p_desconto,$data_criacao,$final_image,$p_estado,$p_subcategoria), "p_produto");


    if($addProduto){



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


        }else{


            $status = array(
                'estado'=>'upload'
            );

            echo json_encode($status);


        }
}else{


    $status = array(
        'estado'=>'login'
    );

    echo json_encode($status);


}


