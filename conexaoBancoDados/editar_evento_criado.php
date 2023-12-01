<?php
session_start();
require_once('conexao_db.php');
// array de resposta
ini_set('display_errors', 1);
$resposta = array();

if (isset($_POST["nome"]) && isset($_POST["min_pessoas"]) && isset($_POST["max_pessoas"]) && isset($_POST["descricao"]) && isset($_SESSION["evento_atual"]) && isset($_POST['classificacao'])) {
    $nome = $_POST["nome"];
    $min = $_POST["min_pessoas"];
    $max = $_POST["max_pessoas"];
    $desc = $_POST["descricao"];
    $id = $_SESSION["evento_atual"];
    $esporte = $_POST["classificacao"];

    if ($_FILES["foto_evento"]["size"] > 0){
		$foto = NULL;
		$client_id = "6d2b5be8400b2b3";
		$filename = $_FILES['foto_evento']['tmp_name'];
	
		$image_data = file_get_contents($filename);
		$image_data_base64 = base64_encode($image_data);
	
		$api_url = 'https://api.imgur.com/3/image.json';
	
		$headers = [
			'Authorization: Client-ID ' . $client_id
		];
	
		$postData = [
			'image' => $image_data_base64
		];
	
		$options = [
			'http' => [
				'header' => implode("\r\n", $headers),
				'method' => 'POST',
				'content' => http_build_query($postData)
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

		if ($foto == NULL){
            $edicao = $db_con->prepare("UPDATE evento SET nome = '$nome', min_pessoas = $min, max_pessoas = $max, descricao = '$desc', fk_classificacao_id = $esporte  WHERE id = $id");
        } else {
            $edicao = $db_con->prepare("UPDATE evento SET foto = '$foto', nome = '$nome', min_pessoas = $min, max_pessoas = $max, descricao = '$desc', fk_classificacao_id = $esporte  WHERE id = $id");
        }
    } else {
        $edicao = $db_con->prepare("UPDATE evento SET nome = '$nome', min_pessoas = $min, max_pessoas = $max, descricao = '$desc', fk_classificacao_id = $esporte  WHERE id = $id");
    }
    
    $edicao->execute();
    $db_con = null;
    header("Location: ../evento.php?id_evento=$id");
}
?>