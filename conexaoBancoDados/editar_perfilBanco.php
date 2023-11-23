<?php
// conexão com bd
require_once('conexao_db.php');

$resposta = array();

if (isset($_POST["emailCampo"]) && isset($_POST["nomeCampo"]) && isset($_POST["telefoneCampo"]) && isset($_POST["dataCampo"]) && isset($_POST["jogabilidade"])){
    $email = trim($_POST["emailCampo"]);
    $nome = trim($_POST["nomeCampo"]);
    $telefone = trim($_POST["telefoneCampo"]);
    $data_nascimento = trim($_POST["dataCampo"]);
    $intuito = trim($_POST["jogabilidade"]);
    ini_set('display_errors', 1);
    if ($_FILES["foto"]["size"] > 0){
        $client_id = "6d2b5be8400b2b3";
        $filename = $_FILES['foto']['tmp_name'];
        
        $image_data = file_get_contents($filename);
        $image_data_base64 = base64_encode($image_data);
        
        $api_url = 'https://api.imgur.com/3/image.json';
        
        $headers = [
            'Authorization: Client-ID ' . $client_id,
            'Content-Type: application/x-www-form-urlencoded'
        ];
        
        $postData = http_build_query(['image' => $image_data_base64]);
        
        $options = [
            'http' => [
                'header' => implode("\r\n", $headers),
                'method' => 'POST',
                'content' => $postData
            ]
        ];
        
        $context = stream_context_create($options);
        $result = file_get_contents($api_url, false, $context);
        
        if ($result === FALSE) {
            echo "Erro ao enviar arquivo para o Imgur";
        } else {
            $response = json_decode($result, true);
            $foto = $response['data']['link'];
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