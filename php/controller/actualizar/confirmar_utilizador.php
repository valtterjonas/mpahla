<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 10-01-2019
 * Time: 09:31
 */

date_default_timezone_set("Africa/Maputo");

include_once ("../../dao/pesquisa.php");
include_once ("../../dao/actualizar.php");

$u_nome = $_REQUEST["u_nome"];
$u_email = $_REQUEST["u_email"];
$data = date_create()->format("Y-m-d H:i:s");

$utilizador = select("u_utilizador","u_estado", "WHERE md5(u_email) = '$u_email'");

    if($utilizador[0]["u_estado"]=="1"){

            $mensagem = array(
                'estado'=>'activo',
                'email'=>$u_email
            );
            echo json_encode($mensagem);

    }else if($utilizador[0]["u_estado"]=="0"){

        $actualizar = atualizar("u_estado",1, "u_utilizador", "WHERE md5(u_email) = '$u_email'");

        if($actualizar){


            $atualizar = atualizar("u_last_login", "$data",
                "u_utilizador", "WHERE md5(u_email) = '$u_email'");

            if($actualizar){


                $users = select("u_utilizador", "*", "WHERE md5(u_email) LIKE '$u_email'");


                if($users){

                    $_SESSION['loggedin'] = true;
                    $_SESSION["usuario_codigo"] = $users[0]["u_id"];
                    $_SESSION["usuario_nome"] = $users[0]["u_nome"];
                    $_SESSION["usuario_email"] = $users[0]["u_email"];
                    $_SESSION["usuario_contacto"] = $users[0]["u_contacto"];
                    $_SESSION["usuario_endereco"] = $users[0]["u_endereco"];
                    $_SESSION["usuario_tipo"] = "cliente";


                    $mensagem = array(
                        'estado'=>'sucesso',
                        'email'=>$u_email
                    );
                    echo json_encode($mensagem);


                }




            }



        }

    }

