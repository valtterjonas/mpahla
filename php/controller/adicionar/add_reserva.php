<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 16-12-2018
 * Time: 15:07
 */


date_default_timezone_set("Africa/Maputo");

include_once ("../../dao/pesquisa.php");
include_once ("../../dao/adicionar.php");
include_once ("../../dao/actualizar.php");
require ("../../../mailer.php");


if($_SESSION['loggedin']) {

    $caixa_id = $_REQUEST["caixa_id"];
    $nome_reserva = $_REQUEST["nome_reserva"];
    $quantidade = $_REQUEST["quantidade"];
    $u_email = $_SESSION["usuario_email"];
    $u_id = $_SESSION["usuario_codigo"];
    $data_criacao = date("Y/m/d H:i:s");
    $end_data_criacao = date('Y-m-d', strtotime('+15 year', strtotime($data_criacao)));
    $last24 = date('Y-m-d', strtotime('-1 day', strtotime($data_criacao)));


    $minhasReservas = select("r_reserva", "r_id", "WHERE u_id = '$u_id' AND r_estado LIKE 'pendente'");

    $reservasAnteriores = select("r_reserva","r_id","WHERE u_id = '$u_id' AND c_id = '$caixa_id' AND r_created_on >= '$last24'");


    if (count($minhasReservas) < 3) {

    if(!$reservasAnteriores) {


        $addReserva = adicionar(array("r_nome", "r_estado", "r_quantidade", "u_id", "c_id", "r_created_by", "r_modified_by", "r_created_on", "r_modified_on", "r_start_date", "r_end_date"),
            array($nome_reserva, "pendente", $quantidade, $u_id, $caixa_id, $u_id, $u_id, $data_criacao, $data_criacao, $data_criacao, $end_data_criacao), "r_reserva");


        $admins = select("u_utilizador", "u_email", "WHERE ug_id = '1'");

        $comma_separated_emails = $admins[0]["u_email"];



        if ($addReserva) {


            $c_quantidade = select("c_caixa", "c_quantidade", "WHERE c_id = '$caixa_id'");

            $get_link = select("c_configs","c_valor","WHERE c_tipo LIKE 'link_reserva'");

            $nova_quantidade = intval($c_quantidade[0]["c_quantidade"]) - intval($quantidade);

            $actualizar = atualizar("c_quantidade", $nova_quantidade, "c_caixa", "WHERE c_id = '$caixa_id'");


            $reserva = select("r_reserva", "MAX(r_id) AS 'id'");

            $token = md5($reserva[0]["id"]);

            $subject = "Nova reserva - " . $nome_reserva;
            $link = $get_link[0]["c_valor"]."reserva-page.html?token=" . $reserva[0]["id"];
            $body = "Saudacoes Admin!!! <br>Há uma nova reserva na loja You&You. Aceda ao link abaixo para visualizar<br>" . $link . "<br> <br>Equipe do You&You";
            $from = "noreply@youandyoubox.com";


            if (enviarEmail($comma_separated_emails,$body,$subject,$from,"you&you")) {

                $mensagem = array(
                    'estado' => 'sucesso'
                );
                echo json_encode($mensagem);

        } else {

                $mensagem = array(
                    'estado' => 'email'
                );
                echo json_encode($mensagem);


            }

        } else {


            $mensagem = array(
                'estado' => 'erro'
            );
            echo json_encode($mensagem);


        }


    }else{


        $mensagem = array(
            'estado' => 'limite_diario'
        );
        echo json_encode($mensagem);

    }


}else {

        $mensagem = array(
            'estado' => 'reserva'
        );
        echo json_encode($mensagem);

}


}else{


    $status = array(
        'estado'=>'login'
    );

    echo json_encode($status);


}



function send_mail($to, $subject, $body, $from) {

    // This will provide plenty adequate entropy
    $multipartSep = '-----'.md5(time()).'-----';

    // Arrays are much more readable
    $headers = array(
        "From: $from",
        "Reply-To: $from",
        "Content-Type: multipart/mixed; boundary=\"$multipartSep\""
    );


    // Make the body of the message
    $body = "--$multipartSep\r\n"
        . "Content-Type: text/plain; charset=UTF-8; format=flowed\r\n"
        . "Content-Transfer-Encoding: 7bit\r\n"
        . "\r\n"
        . "$body\r\n"
        . "--$multipartSep\r\n";


    // Send the email, return the result
    return @mail($to, $subject, $body, implode("\r\n", $headers));

}


