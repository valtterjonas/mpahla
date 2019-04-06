<?php
/**
 * Created by PhpStorm.
 * User: TechJonas
 * Date: 07/23/2018
 * Time: 2:16 PM
 */
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
date_default_timezone_set("Africa/Maputo");

include_once ("../dao/pesquisa.php");
include_once("../dao/actualizar.php");

$username = $_REQUEST["username"];
$senha = md5($_REQUEST["password"]);
$tipo_usuario = $_REQUEST["tipo_usuario"];
$data = date_create()->format("Y-m-d H:i:s");


$utilizador = select("u_utilizador", "*", "WHERE u_email LIKE '$username'");

$_SESSION['loggedin'] = false;


if($utilizador){

$users = select("u_utilizador", "*", "WHERE u_email LIKE '$username' AND u_senha LIKE '$senha'");

if(strcmp($users[0]["u_estado"],"1") == 0) {

    if ($users != null) {

        $usuario_codigo = $users[0]["u_id"];
        $usuario_grupo = $users[0]["ug_id"];

        if (strcmp($usuario_grupo, "2") == 0) {

            //Coloque aqui as intrucoes, ele ja foi autorizado
            //Utilizador cliente

            $atualizar = atualizar("u_last_login", "$data",
                "u_utilizador", "WHERE u_id LIKE '$usuario_codigo'");

            $_SESSION['loggedin'] = true;
            $_SESSION["usuario_codigo"] = $users[0]["u_id"];
            $_SESSION["usuario_nome"] = $users[0]["u_nome"];
            $_SESSION["usuario_email"] = $users[0]["u_email"];
            $_SESSION["usuario_contacto"] = $users[0]["u_contacto"];
            $_SESSION["usuario_endereco"] = $users[0]["u_endereco"];
            $_SESSION["usuario_tipo"] = "cliente";

            $status = array(
                'estado' => 'sucesso',
                'nome' => $users[0]["u_nome"],
                'tipo' => 'cliente',
                'email' => $_SESSION["usuario_email"],
                'contacto' => $_SESSION["usuario_contacto"],
                'endereco' => $_SESSION["usuario_endereco"]
            );

            echo json_encode($status);

        } else if (strcmp($usuario_grupo, "1") == 0) {

            //Coloque aqui as intrucoes, ele ja foi autorizado
            //Utilizador Administrador

            $atualizar = atualizar("u_last_login", "$data",
                "u_utilizador", "WHERE u_id LIKE '$usuario_codigo'");

            $_SESSION['loggedin'] = true;
            $_SESSION["usuario_codigo"] = $users[0]["u_id"];
            $_SESSION["usuario_nome"] = $users[0]["u_nome"];
            $_SESSION["usuario_email"] = $users[0]["u_email"];
            $_SESSION["usuario_contacto"] = $users[0]["u_contacto"];
            $_SESSION["usuario_endereco"] = $users[0]["u_endereco"];
            $_SESSION["usuario_tipo"] = "admin";


            $status = array(
                'estado' => 'sucesso',
                'nome' => $users[0]["u_nome"],
                'tipo' => 'admin',
                'email' => $_SESSION["usuario_email"],
                'contacto' => $_SESSION["usuario_contacto"],
                'endereco' => $_SESSION["usuario_endereco"]
            );

            echo json_encode($status);

        }

    } else {

        $status = array(
            'estado' => 'invalido'
        );

        echo json_encode($status);

    }

}else{

    $status = array(
        'estado'=>'pendente'
    );

    echo json_encode($status);

}

}else{

    $status = array(
        'estado'=>'invalido'
    );

    echo json_encode($status);


}

