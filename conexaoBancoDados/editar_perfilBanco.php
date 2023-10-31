<?php
// conexão com bd
require_once('conexao_db.php');

// autenticação
require_once('autenticacao.php');
$resposta = array();


if (isset($_POST["emailCampo"]) && isset($_POST["nomeCampo"]) && isset($_POST["telefoneCampo"]) && isset($_POST["dataCampo"]) && isset($_POST["jogabilidade"])){
    $email = trim($_POST["emailCampo"]);
    $nome = trim($_POST["nomeCampo"]);
    $telefone = trim($_POST["telefoneCampo"]);
    $data_nascimento = trim($_POST["dataCampo"]);
    $intuito = trim($_POST["jogabilidade"]);

    if ($_FILES["foto"]["size"] > 0){
        $curl = curl_init();
        $client_id="6d2b5be8400b2b3";
        $filename = $_FILES['foto']['tmp_name'];    
        $handle = fopen($filename, "r");
        $data = fread($handle, filesize($filename));
        $pvars   = array('image' => base64_encode($data));
        $timeout = 30;

        if ($curl === false) {
            // Lidar com erro na inicialização do cURL
            echo "Erro ao inicializar cURL";
        } else {
            // Configurar e executar a solicitação cURL
            curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
            curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            
            $result = curl_exec($curl);

            if ($result === false) {
                // Lidar com erro na execução da solicitação
                echo "Erro na execução do cURL: " . curl_error($curl);
            } else {
                // Processar a resposta
                $pms = json_decode($result,true);
                $foto = $pms['data']['link'];
            }

            // Fechar a sessão cURL
            curl_close($curl);
        }

        $consulta = $db_con->prepare("UPDATE usuario set nome='$nome', telefone='$telefone', data_nascimento='$data_nascimento', fk_intuito_id='$intuito', foto='$foto' WHERE email='$email'");
        $resposta["sucesso"] = 1;
        $consulta->execute();
    } else {
        $consulta = $db_con->prepare("UPDATE usuario set nome='$nome', telefone='$telefone', data_nascimento='$data_nascimento', fk_intuito_id='$intuito' WHERE email='$email'");
        $resposta["sucesso"] = 1;
        $consulta->execute();
    }
}else{
    $resposta["sucesso"] = 0;
    $resposta["erro"] = "Faltam parâmetros";
}

// envia pra outra pagina
session_start();
require_once("carregar_detalhes_logado.php");
$db_con = null;
header("location: ../perfil.php");
?>