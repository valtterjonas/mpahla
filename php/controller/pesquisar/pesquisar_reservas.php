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


    $reservas = select("r_reserva,u_utilizador,c_caixa",
        "r_reserva.*,u_utilizador.u_nome,c_caixa.c_nome",
        "WHERE c_caixa.c_id = r_reserva.c_id AND u_utilizador.u_id = r_reserva.u_id ORDER BY r_reserva.r_id DESC");


    $resposta = "";

    //echo json_encode($reservas);


    if($reservas){


        for($i = 0; $i < count($reservas); $i++){

            $nome = $reservas[$i]["u_nome"];
            $r_id = $reservas[$i]["r_id"];
            $data_criacao = $reservas[$i]["r_created_on"];
            $data_expiracao = date('Y-m-d H:i:s', strtotime('+48 hour', strtotime($data_criacao)));
            $item = $reservas[$i]["c_nome"];
            $qtd = $reservas[$i]["r_quantidade"];
            $estado = $reservas[$i]["r_estado"];

            $span_pendente = "warning";

            if(strcmp($estado,"entregue") == 0){

                $span_pendente = "success";

            }else if(strcmp($estado,"pago") == 0){
                $span_pendente = "info";

            }else if(strcmp($estado,"cancelado") == 0){
                $span_pendente = "danger";

            }

            $resposta.='
                                <tr>
									<td>'.$nome.'</td>
									<td>'.$data_criacao.'</td>
									<td>'.$data_expiracao.'</td>
									<td>'.$item.'</td>
									<td>'.$qtd.'</td>
									<td> <span class="label label-'.$span_pendente.'">'.$estado.'</span></td>
									<td>
										<a class="main-btn " href="reserva-page.html?token='.$r_id.'"><i class="fa fa-search-plus"></i> Ver</a>
									</td>
								</tr>

                ';

        }

        echo $resposta;


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
