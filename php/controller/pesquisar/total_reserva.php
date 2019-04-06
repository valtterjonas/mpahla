<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 10-01-2019
 * Time: 15:59
 */

date_default_timezone_set("Africa/Maputo");

include_once ("../../dao/pesquisa.php");

if ($_SESSION['loggedin']) {

    $cliente_id = $_SESSION["usuario_codigo"];

    $reservas = select("r_reserva,u_utilizador,c_caixa",
        "r_reserva.*,u_utilizador.u_nome,c_caixa.c_nome,c_caixa.c_preco",
        "WHERE c_caixa.c_id = r_reserva.c_id AND u_utilizador.u_id = r_reserva.u_id AND r_reserva.u_id = '$cliente_id' AND r_reserva.r_estado LIKE 'pendente' ORDER BY r_reserva.r_id DESC");


    $total_reserva = 0.0;

    // echo json_encode($reservas);



    if($reservas){


        for($i = 0; $i < count($reservas); $i++){

          $total_reserva = $total_reserva + $qtd = $reservas[$i]["r_quantidade"] * $reservas[$i]["c_preco"];

        }

        $status = array(
            'estado'=>'sucesso',
            'total_reserva'=>number_format($total_reserva,2,'.',',')." MT",
            'numero_reserva'=>count($reservas)
        );

        echo json_encode($status);

    }else{

        $status = array(
            'estado'=>'erro'
        );

        echo json_encode($status);

    }





} else {

    $status = array(
        'estado'=>'login'
    );

    echo json_encode($status);

}
