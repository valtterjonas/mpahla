<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 22-01-2019
 * Time: 13:04
 */




date_default_timezone_set("Africa/Maputo");

include_once ("../../dao/adicionar.php");
include_once ("../../dao/pesquisa.php");
include_once ("../../dao/actualizar.php");


if(true){


    $c_id = $_REQUEST["caixa_id"];
    $c_nome = $_REQUEST["nome_caixa"];
    $c_quantidade = $_REQUEST["quantidade"];
    $c_preco = $_REQUEST["preco"];
    $c_descricao = $_REQUEST["descricao"];

    $data_criacao = date("Y/m/d H:i:s");
    $estado = "pendente";
    $ug_id = 2;
    $usuario_codigo = $_SESSION["usuario_codigo"];
    $end_data_criacao = date('Y-m-d', strtotime('+15 year', strtotime($data_criacao)));
    $u_cod_confirmacao = rand(1000,9000);


        $addCaixa = adicionar(array("c_nome","c_preco","c_quantidade","c_descricao","c_created_by","c_modified_by","c_created_on","c_modified_on","c_start_date","c_end_date"),
            array($c_nome,$c_preco,$c_quantidade,$c_descricao,$usuario_codigo,$usuario_codigo,$data_criacao,$data_criacao,$data_criacao,$end_data_criacao), "c_caixa");


        if($addCaixa){


            $actualizarCaixa = atualizar("c_end_date",$data_criacao, "c_caixa", "WHERE c_id = '$c_id'");

            if($actualizarCaixa){

                $caixa = select("c_caixa","MAX(c_id) AS 'id'");

                $new_cid = $caixa[0]["id"];

                $actualizarFotos = atualizar("c_id",$new_cid, "ic_imagem_caixa","WHERE c_id = '$c_id'");

                if($actualizarFotos){

                    $actualizarReserva = atualizar("c_id",$new_cid,"r_reserva","WHERE c_id = '$c_id'");


                    if($actualizarReserva){

                        $mensagem = array(
                            'estado'=>'sucesso'
                        );
                        echo json_encode($mensagem);

                    }



                }


            }




        }else{

            $mensagem = array(
                'estado'=>'erro'
            );
            echo json_encode($mensagem);

        }


}else{


    $status = array(
        'estado'=>'login'
    );

    echo json_encode($status);


}

