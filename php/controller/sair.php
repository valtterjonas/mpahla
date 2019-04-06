<?php
/**
 * Created by PhpStorm.
 * User: TechJonas
 * Date: 08/10/2018
 * Time: 14:52
 */

session_start();

session_destroy();

$status = array(
    'estado'=>'sucesso'
);

echo json_encode($status);
