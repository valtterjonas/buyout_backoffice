<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 14-01-2019
 * Time: 14:03
 */

include_once("php/dao/pesquisa.php");
include_once("php/dao/adicionar.php");

date_default_timezone_set("Africa/Maputo");

$data_actual = date("Y-m-d H:i:s");


function counterClientes()
{
    $clientes = select("u_utilizador", "COUNT(u_id) as 'total'", "WHERE u_grupo = 2");
    echo $clientes[0]["total"];

}

function counterComprasEntregues()
{
    $compras_entregues = select("c_compra c, ce_compra_estado ce", "COUNT(c.c_id) as 'total'", "WHERE c.ce_id = ce.ce_id AND ce.ce_estado LIKE 'entregue'");
    echo $compras_entregues[0]["total"];

}

function counterComprasPendentes()
{
    $compras_pendentes = select("c_compra c, ce_compra_estado ce", "COUNT(c.c_id) as 'total'", "WHERE c.ce_id = ce.ce_id AND ce.ce_estado LIKE 'pendente'");
    echo $compras_pendentes[0]["total"];

}

function counterMotoristas()
{
    $motoristas = select("u_utilizador", "COUNT(u_id) as 'total'", "WHERE u_grupo = 3");
    echo $motoristas[0]["total"];

}
