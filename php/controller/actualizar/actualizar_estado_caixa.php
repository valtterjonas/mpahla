<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 22-01-2019
 * Time: 11:43
 */

date_default_timezone_set("Africa/Maputo");


include_once ("../../dao/adicionar.php");
include_once ("../../dao/actualizar.php");

$token = $_REQUEST["token"];
$estado = $_REQUEST["estado"];


$actualizar = atualizar("c_estado",$estado, "c_caixa", "WHERE c_id = '$token'");


if($actualizar){


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
