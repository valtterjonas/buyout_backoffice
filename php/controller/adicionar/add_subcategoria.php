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


    $s_nome = $_REQUEST["s_nome"];
    $s_descricao = $_REQUEST["s_descricao"];
    $s_categoria = $_REQUEST["s_categoria"];
    $img = $_FILES['s_imagem']['name'];
    $tmp = $_FILES['s_imagem']['tmp_name'];


    $data_criacao = date("Y/m/d H:i:s");
    $estado = "pendente";


    // can upload same image using rand function
    $final_image = rand(1000,1000000).$img;



    $path1 = $path.strtolower($final_image);



    if(move_uploaded_file($tmp,$path1)) {


    $addCataegoria = adicionar(array("s_nome","s_descricao","s_imagem","c_id"),
        array($s_nome,$s_descricao,$final_image,$s_categoria), "s_subcategoria");


    if($addCataegoria){



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


