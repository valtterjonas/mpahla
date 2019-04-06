<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 18-02-2019
 * Time: 14:18
 */


date_default_timezone_set("Africa/Maputo");


include_once ("../../dao/pesquisa.php");
require ("../../../mailer.php");

$texto = $_REQUEST["texto_opiniao"];

$_SESSION["usuario_email"];

$admins = select("u_utilizador","u_email", "WHERE ug_id = '1'");

$admin_email = $admins[0]["u_email"];

$subject = "Opiniao ou Reclamacao - ".$_SESSION["usuario_email"];
$body = "Saudacoes Admin!!!<br>Há uma nova opinião ou reclamação na loja You&You. Acompanhe abaixo:<br> Nome: ".$_SESSION["usuario_nome"]."<br> Email: ".$_SESSION["usuario_email"]."<br> Opinião: <strong>".$texto."</strong> . <br><br>Equipe do You&You";
$from = "noreply@youandyoubox.com";


if(enviarEmail($admin_email,$body,$subject,$from,"you&you")){

    $mensagem = array(
        'estado'=>'sucesso'
    );
    echo json_encode($mensagem);


}else{

    $mensagem = array(
        'estado'=>'email'
    );
    echo json_encode($mensagem);

}


