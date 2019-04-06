<?php
/**
 * Created by PhpStorm.
 * User: TechJonas
 * Date: 08/10/2018
 * Time: 14:40
 */

    session_start();

    date_default_timezone_set("Africa/Maputo");


    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

        $status = array(
            'estado'=>'sessao',
            'u_nome'=>$_SESSION["usuario_nome"],
            'u_email'=>$_SESSION["usuario_email"],
            'u_tipo'=>$_SESSION["usuario_tipo"],
            'email'=>$_SESSION["usuario_email"],
            'contacto'=>$_SESSION["usuario_contacto"],
            'endereco'=>$_SESSION["usuario_endereco"]
        );

        echo json_encode($status);

    } else {

        $status = array(
            'estado'=>'erro'
        );

        echo json_encode($status);

    }

