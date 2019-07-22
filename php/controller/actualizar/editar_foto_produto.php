<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 20-07-2019
 * Time: 20:34
 */

date_default_timezone_set("Africa/Maputo");

include_once ("../../dao/actualizar.php");
include_once ("../../dao/pesquisa.php");
include_once ("../../dao/apagar.php");


if(true){

    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
    $path = '../../../images/produtos/'; // upload directory

    $p_imagem = $_REQUEST["p_imagem"];
    $p_id = $_REQUEST["p_id"];

    $img = $_FILES['p_imagem']['name'];


    $tmp = $_FILES['p_imagem']['tmp_name'];

    // can upload same image using rand function
    $final_image = rand(1000,1000000).$img;



    $path1 = $path.strtolower($final_image);


    if(move_uploaded_file($tmp,$path1)) {


        $actProduto = atualizar("p_imagem",
            $final_image, "p_produto","WHERE p_id = '$p_id'");


        if($actProduto){



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


