<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 09-01-2019
 * Time: 12:00
 */

$u_nome = "dddd";

$subject = "Confirmação de email";
$link = "https://youandyoubox.com/confirmar_conta.php?token=".$u_cod_confirmacao = 1;
$body = "Saudacoes ".$u_nome."!!!\r\nEntre no link abaixo para confirmar a sua conta na You & You.\r\n".$link."\r\n \r\nEquipe do You&You";
$from = "noreply@youandyoubox.com";

echo $mail = mail($u_email="helio.jonas@escopil.co.mz",$subject,$body,$from);