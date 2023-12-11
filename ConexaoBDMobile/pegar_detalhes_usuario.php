<?php
require_once('conexao_db.php');


// array de resposta
$resposta = array();


// Verifica se o parametro id foi enviado na requisicao
if (isset($_GET["email"])) {
	
	// Aqui sao obtidos os parametros
	$email = $_GET['email'];
	
	// Obtem do BD os detalhes do produto com id especificado na requisicao GET
	$consulta = $db_con->prepare("SELECT * FROM usuario WHERE email = '" . $email . "'");

	if ($consulta->execute()) {
		if ($consulta->rowCount() > 0) {

			// Se o produto existe, os dados completos do produto 
			// sao adicionados no array de resposta. A imagem nao 
			// e entregue agora pois ha um php exclusivo para obter 
			// a imagem do produto.
			$linha = $consulta->fetch(PDO::FETCH_ASSOC);
			$resposta["nome"] = $linha["nome"];
			$resposta["foto"] = $linha["foto"];
			$resposta["data_nascimento"] = $linha["data_nascimento"];
			$resposta["id"] = $linha["id"];
			$resposta["telefone"] = $linha["telefone"];
			$resposta["intuito"] = $linha["fk_intuito_id"];

			// Caso o usuario exista no BD, o cliente 
			// recebe a chave "sucesso" com valor 1.
			$resposta["sucesso"] = 1;
			
		} else {
			// Caso o produto nao exista no BD, o cliente 
			// recebe a chave "sucesso" com valor 0. A chave "erro" indica o 
			// motivo da falha.
			$resposta["sucesso"] = 0;
			$resposta["erro"] = "Usuario não encontrado";
		}
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
