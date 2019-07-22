<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 20-07-2019
 * Time: 22:40
 */


    include_once("../../dao/pesquisa.php");


    $comprasEntregues = selectjoin("SELECT MONTHNAME(c_data_criacao) mes, SUM(c_preco_total) valor FROM c_compra c 
    GROUP BY MONTH(c_data_criacao) ORDER BY MONTH(c_data_criacao) ASC LIMIT 6");

    if($comprasEntregues){

        $status = array(
          'estado'=>'sucesso',
           'data' => $comprasEntregues
        );

        echo json_encode($status);

    }



