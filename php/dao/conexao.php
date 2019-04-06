
        <?php
//            session_cache_limiter('private');
//
//            $cache_limiter = session_cache_limiter();
//
//            /* Define o limite de tempo do cache em 30 minutos */
//            session_cache_expire(30);
//
//            $cache_expire = session_cache_expire();

            session_start();

			error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);

            function connect($user = "root",$pass = "",$banc = "mpahla_db",$hostname = "localhost"){
//            function connect($user = "root",$pass = "Dev@Server!17",$banc = "youandyoudb_0.1",$hostname = "192.168.100.9"){

//            function connect($user = "root",$pass ="sanoj888",$banc = "roscas_db",$hostname = "localhost"){

                @$conexao = mysql_connect($hostname,$user,$pass);

                mysql_set_charset('utf8',$conexao);

                if(!$conexao){


                   // die(trigger_error("Não foi possivel conectar ao banco de dados"));
                    return false;

                }else{


                    $db = mysql_select_db($banc, $conexao);

                    if(!$db){

                        //die(trigger_error("Não foi possivel conectar ao banco de dados"));

                        return false;

                    }else{

                        return $conexao;

                    }


                }

            }

