<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 12-01-2019
 * Time: 13:00
 */

date_default_timezone_set("Africa/Maputo");

include_once ("../../dao/pesquisa.php");

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {


    $token = $_REQUEST["token"];


    $reserva = select("r_reserva,u_utilizador,c_caixa",
        "r_reserva.*,c_caixa.c_nome,c_caixa.c_preco,u_utilizador.u_nome,u_utilizador.u_endereco,u_utilizador.u_contacto,u_utilizador.u_email,r_reserva.r_quantidade",
        "WHERE r_reserva.r_id = '$token' AND c_caixa.c_id = r_reserva.c_id AND u_utilizador.u_id = r_reserva.u_id");



    if($reserva){

        $token = $reserva[0]["c_id"];

        $fotos = select("ic_imagem_caixa", "ic_nome,ic_foto_path", "WHERE c_id = '$token'");

        if($fotos){

            $mensagem[] = array(
                'estado'=>'sucesso',
                'c_nome'=>$reserva[0]["c_nome"],
                'u_nome'=>$reserva[0]["u_nome"],
                'u_contacto'=>$reserva[0]["u_contacto"],
                'u_endereco'=>$reserva[0]["u_endereco"],
                'r_estado'=>$reserva[0]["r_estado"],
                'r_data_criacao'=>$reserva[0]["r_created_on"],
                'c_preco'=>number_format($reserva[0]["c_preco"],2,'.',',')." MT",
                'r_quantidade'=>$reserva[0]["r_quantidade"],
                'c_id'=>$reserva[0]["c_id"]
            );



            for($i = 0; $i < count($fotos); $i++){

                $imagens[] = array(
                    'ic_nome'=>$fotos[$i]["ic_nome"],
                    'ic_foto_path'=>$fotos[$i]["ic_foto_path"]
                );

            }

            echo json_encode(array_merge($mensagem, $imagens));


        }


    }else{
        $status = array(
            'estado'=>'erro'
        );

        echo json_encode($status);


    }


}else{
    $status = array(
        'estado'=>'login'
    );

    echo json_encode($status);

}
