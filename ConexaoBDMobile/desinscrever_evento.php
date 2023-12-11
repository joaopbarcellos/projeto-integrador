<?php
require_once('conexao_db.php');

// array de resposta
$resposta = array();
// Verifica se o parametro id foi enviado na requisicao
if (isset($_GET["email"]) && isset($_GET["id_evento"])) {
	
	$email = trim($_GET["email"]);
    $id_evento = $_GET["id_evento"];
	
	$consulta_usuario = $db_con->prepare("SELECT * from usuario where email = '$email'");
    $consulta_usuario->execute();
    $linha_usuario = $consulta_usuario->fetch(PDO::FETCH_ASSOC);
    $id_usuario = $linha_usuario["id"];
	$consulta = $db_con->prepare("DELETE from usuario_evento where fk_usuario_id = '$id_usuario' and fk_evento_id = '$id_evento'");
	
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
