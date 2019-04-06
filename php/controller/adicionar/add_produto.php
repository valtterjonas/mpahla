<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 12-01-2019
 * Time: 10:27
 */



date_default_timezone_set("Africa/Maputo");

include_once ("../../dao/adicionar.php");
include_once ("../../dao/pesquisa.php");
include_once ("../../dao/apagar.php");


if(true){

    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
    $path = '../../../img/caixas/'; // upload directory


    $p_nome = $_REQUEST["inputNome"];
    $p_categoria = $_REQUEST["inputCategoria"];
    $p_genero = $_REQUEST["inputGenero"];
    $p_cor = $_REQUEST["inputCor"];
    $p_tamanho = $_REQUEST["inputTamanho"];
    $p_quantidade = $_REQUEST["inputQuantidade"];
    $p_numero = $_REQUEST["inputNumero"];
    $p_descricao = $_REQUEST["inputDescricao"];
    $p_estado = $_REQUEST["inputEstado"];
    $p_preco = $_REQUEST["inputPreco"];

    $p_descricao = trim($p_descricao); // remove the last \n or whitespace character

    $data_criacao = date("Y/m/d H:i:s");
    $pestado = 1;
    $usuario_codigo = 1;
    $end_data_criacao = date('Y-m-d', strtotime('+15 year', strtotime($data_criacao)));
    $u_cod_confirmacao = rand(1000,9000);

/*
    $img = $_FILES['pic']['name'];
    $img2 = $_FILES['pic2']['name'];
    $img3 = $_FILES['pic3']['name'];
    $img4 = $_FILES['pic4']['name'];

    $tmp = $_FILES['pic']['tmp_name'];
    $tmp2 = $_FILES['pic2']['tmp_name'];
    $tmp3 = $_FILES['pic3']['tmp_name'];
    $tmp4 = $_FILES['pic4']['tmp_name'];

    $data_criacao = date("Y/m/d H:i:s");
    $estado = "pendente";
    $ug_id = 2;
    $usuario_codigo = $_SESSION["usuario_codigo"];;
    $end_data_criacao = date('Y-m-d', strtotime('+15 year', strtotime($data_criacao)));
    $u_cod_confirmacao = rand(1000,9000);
    // $u_cod_confirmacao = md5($u_cod_confirmacao);




    // can upload same image using rand function
    $final_image = rand(1000,1000000).$img;
    $final_image2 = rand(1000,1000000).$img2;
    $final_image3 = rand(1000,1000000).$img3;
    $final_image4 = rand(1000,1000000).$img4;


    $path1 = $path.strtolower($final_image);
    $path2 = $path.strtolower($final_image2);
    $path3 = $path.strtolower($final_image3);
    $path4 = $path.strtolower($final_image4);


        if(move_uploaded_file($tmp,$path1) && move_uploaded_file($tmp2,$path2) && move_uploaded_file($tmp3,$path3) && move_uploaded_file($tmp4,$path4)) {

*/
    $addProduto = adicionar(array("p_nome","p_numero","p_quantidade","p_estado","genero_id","tamanho_id","categoria_id","p_created_by","p_modified_by","p_created_on","p_last_modified_on","p_start_date","p_end_date"),
        array($p_nome,$p_numero,$p_quantidade,$p_estado,$p_genero,$p_tamanho,$p_categoria,$usuario_codigo,$data_criacao,$data_criacao,$data_criacao,$end_data_criacao), "p_produto");


    echo json_encode($addProduto);

    if($addProduto){

       /* $caixa = select("c_caixa","MAX(c_id) AS 'id'");

        $c_id = $caixa[0]["id"];

        $addCaixaImagem = adicionar(array("ic_nome","ic_foto_path","c_id","ic_created_by","ic_modified_by","ic_created_on","ic_modified_on","ic_start_date","ic_end_date"),
            array(strtolower($final_image),$path1,$c_id,$usuario_codigo,$usuario_codigo,$data_criacao,$data_criacao,$data_criacao,$end_data_criacao), "ic_imagem_caixa");

                    if($addCaixaImagem){

                            $addCaixaImagem = adicionar(array("ic_nome","ic_foto_path","c_id","ic_created_by","ic_modified_by","ic_created_on","ic_modified_on","ic_start_date","ic_end_date"),
                                array(strtolower($final_image2),$path2,$c_id,$usuario_codigo,$usuario_codigo,$data_criacao,$data_criacao,$data_criacao,$end_data_criacao), "ic_imagem_caixa");

                            $addCaixaImagem = adicionar(array("ic_nome","ic_foto_path","c_id","ic_created_by","ic_modified_by","ic_created_on","ic_modified_on","ic_start_date","ic_end_date"),
                                array(strtolower($final_image3),$path3,$c_id,$usuario_codigo,$usuario_codigo,$data_criacao,$data_criacao,$data_criacao,$end_data_criacao), "ic_imagem_caixa");

                              $addCaixaImagem = adicionar(array("ic_nome","ic_foto_path","c_id","ic_created_by","ic_modified_by","ic_created_on","ic_modified_on","ic_start_date","ic_end_date"),
                              array(strtolower($final_image4),$path4,$c_id,$usuario_codigo,$usuario_codigo,$data_criacao,$data_criacao,$data_criacao,$end_data_criacao), "ic_imagem_caixa");

                            if($addCaixaImagem){

                                $mensagem = array(
                                    'estado'=>'sucesso'
                                );
                                echo json_encode($mensagem);

                            }

                    }else{

                       apagar("c_caixa","WHERE c_id = '$c_id'");

                        $mensagem = array(
                            'estado'=>'erro'
                        );
                        echo json_encode($mensagem);

                    }


            }else{

                $mensagem = array(
                    'estado'=>'erro'
                );
                echo json_encode($mensagem);

            }

       */

        }else{


            $status = array(
                'estado'=>'upload'
            );

            echo json_encode($status);


        }
}else{


    $status = array(
        'estado'=>'login'
    );

    echo json_encode($status);


}


