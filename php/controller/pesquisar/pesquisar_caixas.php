<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 14-01-2019
 * Time: 14:03
 */

include_once("../../dao/pesquisa.php");
include_once("../../dao/adicionar.php");

date_default_timezone_set("Africa/Maputo");

$data_actual = date("Y-m-d H:i:s");

$preco = $_REQUEST["preco"];

if (true) {

    if (intval($preco) == 0) {
        $caixas = select("c_caixa,ic_imagem_caixa", "c_caixa.c_nome,c_caixa.c_quantidade, c_caixa.c_preco,c_caixa.c_id,ic_imagem_caixa.ic_nome",
            "WHERE c_caixa.c_estado NOT LIKE 'suspenso' 
            AND c_caixa.c_id = ic_imagem_caixa.c_id
            AND '$data_actual' < c_end_date
             GROUP BY c_caixa.c_id ORDER BY c_caixa.c_created_on DESC");
    } else {
            $caixas = select("c_caixa,ic_imagem_caixa", "c_caixa.c_nome,c_caixa.c_quantidade, c_caixa.c_preco,c_caixa.c_id,ic_imagem_caixa.ic_nome", "
            WHERE c_caixa.c_estado NOT LIKE 'suspenso' 
            AND c_caixa.c_id = ic_imagem_caixa.c_id 
            AND '$data_actual' < c_end_date
            AND c_caixa.c_preco = $preco 
            GROUP BY c_caixa.c_id ORDER BY c_caixa.c_created_on DESC");
    }


    $resposta = "";

    if ($caixas) {


        for ($i = 0; $i < count($caixas); $i++) {

            $foto_principal = $caixas[$i]["ic_nome"];
            $nome_caixa = $caixas[$i]["c_nome"];
            $preco_caixa = number_format($caixas[$i]["c_preco"], 2, '.', ',') . " MT";
            $c_id = $caixas[$i]["c_id"];

            $accao = "Reservar";
            $class = "";
            $fawesome = "fa-shopping-cart";

            if (intval($caixas[$i]["c_quantidade"]) == 0) {
                $accao = "Out of Stock";
                $class = "cinz";
                $fawesome = "fa-ban";
            }


            $resposta .= '
                			<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<a class="main-btn quick-view" href="product-page.html?token=' . $c_id . '"><i class="fa fa-search-plus"></i> Ver</a>
							<img src="./img/caixas/' . $foto_principal . '" alt="">
						</div>
						<div class="product-body">
							<h3 class="product-price">' . $preco_caixa . '</h3>
							<h3 class="product-name "><a href="product-page.html?token=' . $c_id . '">' . $nome_caixa . '</a></h3>
							<div class="product-btns text-center">

								<button class="primary-btn add-to-cart ' . $class . '" onclick="reservarCaixa(' . $c_id . ')" name="jjj" on> <i class="fa ' . $fawesome . '"></i> ' . $accao . '</button>
							</div>
						</div>
					</div>
				</div>
                ';

        }

        echo $resposta;


    }


} else {

    $status = array(
        'estado' => 'login'
    );

    echo json_encode($status);

}
