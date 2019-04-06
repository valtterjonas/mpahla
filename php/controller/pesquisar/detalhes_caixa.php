<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 12-01-2019
 * Time: 13:00
 */

date_default_timezone_set("Africa/Maputo");

include_once ("../../dao/pesquisa.php");

if (true) {


    $token = $_REQUEST["token"];


    $caixa = select("c_caixa", "c_id, c_nome, c_quantidade, c_preco, c_descricao, c_estado", "WHERE c_id = '$token'");

    if($caixa){

    $fotos = select("ic_imagem_caixa", "ic_nome,ic_foto_path", "WHERE c_id = '$token'");

    if($fotos){

        $quantidade = $caixa[0]["c_quantidade"];

        if(intval($caixa[0]["c_quantidade"])==0){
           $quantidade = "Out of Stock";
        }

        $mensagem[] = array(
            'estado'=>'sucesso',
            'c_nome'=>$caixa[0]["c_nome"],
            'c_preco'=>number_format($caixa[0]["c_preco"],2,'.',',')." MT",
            'c_preco2'=>$caixa[0]["c_preco"],
            'c_quantidade'=>$quantidade,
            'c_quantidade2'=>$caixa[0]["c_quantidade"],
            'c_descricao'=>nl2br($caixa[0]["c_descricao"]),
            'c_descricao2'=>$caixa[0]["c_descricao"],
            'c_estado'=>$caixa[0]["c_estado"],
            'c_id'=>$caixa[0]["c_id"]
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
