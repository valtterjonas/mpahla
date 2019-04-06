<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 19-01-2019
 * Time: 12:08
 */


date_default_timezone_set("Africa/Maputo");


include_once ("../../dao/pesquisa.php");
require ("../../../mailer.php");


$email = $_REQUEST["email"];

$admins = select("u_utilizador","u_email", "WHERE ug_id = '1'");

$admin_email = $admins[0]["u_email"];

$subject = "Feed de noticias - ".$email;
$body = "Saudacoes Admin!!!<br>Há uma nova subscrição para feed de notícias na loja You&You do utilizador com o email<br>".$email."<br> <br>Equipe do You&You";
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


function send_mail($to, $subject, $body, $from) {

    // This will provide plenty adequate entropy
    $multipartSep = '-----'.md5(time()).'-----';

    // Arrays are much more readable
    $headers = array(

        "From: $from",
        "Reply-To: $from",
        "X-Mailer: PHP/" . phpversion(),
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