<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 31-03-2019
 * Time: 18:54
 */


include_once("../../dao/pesquisa.php");
include_once("../../dao/adicionar.php");

date_default_timezone_set("Africa/Maputo");

$data_actual = date("Y-m-d H:i:s");

if (true) {


    $tamanhos = select("t_tamanho", "t_id,t_nome");

    $resposta = array();

    if ($tamanhos) {

        for ($i = 0; $i < count($tamanhos); $i++) {


            $resposta[] = array(
                't_id'=>$tamanhos[$i]["t_id"],
                't_nome'=>$tamanhos[$i]["t_nome"]
            );

        }

        echo json_encode($resposta);

    }

} else {

    $status = array(
        'estado' => 'login'
    );

    echo json_encode($status);

}
