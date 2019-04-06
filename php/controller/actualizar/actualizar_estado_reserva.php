<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 15-01-2019
 * Time: 15:08
 */

date_default_timezone_set("Africa/Maputo");

include_once ("../../dao/adicionar.php");
include_once ("../../dao/actualizar.php");

$token = $_REQUEST["token"];
$estado = $_REQUEST["estado"];


$actualizar = atualizar("r_estado",$estado, "r_reserva", "WHERE r_id = '$token'");


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

