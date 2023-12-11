<?php
require_once('conexao_db.php');

// array de resposta
$resposta = array();

// Verifica se o parametro id foi enviado na requisicao
if (isset($_POST["id"]) && isset($_POST["nome"]) && isset($_POST["capacidade_max"]) && isset($_POST["capacidade_min"]) && isset($_POST["descricao"])) {
	
	// Aqui sao obtidos os parametros
	$id = $_POST['id'];
	$nome = trim($_POST["nome"]);
    $capacidade_max = $_POST["capacidade_max"];
    $capacidade_min = $_POST["capacidade_min"];
    $descricao = trim($_POST["descricao"]);

	$consulta = $db_con->prepare("UPDATE evento set nome='$nome', max_pessoas = '$capacidade_max', min_pessoas = '$capacidade_min', descricao = '$descricao' WHERE id='$id'");
	$resposta["sucesso"] = 1;
	
	if ($consulta->execute()) {
		$resposta["sucesso"] = 1;
	} else {
		// Caso ocorra falha no BD, o cliente 
		// recebe a chave "sucesso" com valor 0. A chave "erro" indica o 
		// motivo da falha.
		$resposta["sucesso"] = 0;
		$resposta["erro"] = "Erro no BD: " . $consulta->$error;
	}
} else {
	// Se a requisicao foi feita incorretamente, ou seja, os parametros 
	// nao foram enviados corretamente para o servidor, o cliente 
	// recebe a chave "sucesso" com valor 0. A chave "erro" indica o 
	// motivo da falha.
	$resposta["sucesso"] = 0;
	$resposta["erro"] = "Campo requerido não preenchido";
}

// Fecha a conexao com o BD
$db_con = null;

// Converte a resposta para o formato JSON.
echo json_encode($resposta);
?>
