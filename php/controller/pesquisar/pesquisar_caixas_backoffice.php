<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 22-01-2019
 * Time: 11:56
 */

date_default_timezone_set("Africa/Maputo");

include_once ("../../dao/pesquisa.php");
include_once ("../../dao/adicionar.php");

$data_actual = date("Y-m-d H:i:s");



$caixas = select("c_caixa","c_caixa.c_nome,c_caixa.c_quantidade,c_caixa.c_estado,c_caixa.c_preco,c_caixa.c_id,c_caixa.c_end_date",
"WHERE '$data_actual' < c_end_date ORDER BY c_caixa.c_created_on DESC");





if($caixas){

    $resposta = "";

    for($i = 0; $i < count($caixas); $i++){

        $estado = $caixas[$i]["c_estado"];

        $span_pendente = "default";

        if(strcmp($estado,"suspenso") == 0){

            $span_pendente = "danger";

        }else if(strcmp($estado,"") == 0){
            $span_pendente = "info";

        }


    $resposta .= '
    
                                        <tr>

											<td class="">'.$caixas[$i]["c_nome"].'</td>
											<td class="">'.$caixas[$i]["c_quantidade"].'</td>
											<td class=""><span class="label label-'.$span_pendente.'">'.$estado.'</span></td>
											<td class="text-center"><a href="editar-caixa.html?token='.$caixas[$i]["c_id"].'"><i class="fa fa-edit"> Editar</i> </a>  </td>
										

										</tr>
    
    
    
    ';

    }

    echo $resposta;

}else{


}
