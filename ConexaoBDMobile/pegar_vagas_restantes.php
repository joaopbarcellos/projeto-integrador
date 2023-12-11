<?php

/*
 * O codigo seguinte retorna os dados detalhados de um produto.
 * Essa e uma requisicao do tipo GET. Um produto e identificado 
 * pelo campo id.
 */

// conexão com bd
require_once('conexao_db.php');


// array de resposta
$resposta = array();


// Verifica se o parametro id foi enviado na requisicao
if (isset($_POST["id"])) {
	
	// Aqui sao obtidos os parametros
	$id = $_POST['id'];
	
	// Obtem do BD os detalhes do produto com id especificado na requisicao GET
	$consulta = $db_con->prepare("SELECT * FROM evento WHERE id = $id");

	if ($consulta->execute()) {
		if ($consulta->rowCount() > 0) {
			$consulta_inscritos = $db_con->prepare("SELECT * FROM usuario_evento WHERE fk_evento_id = " . $id);
			$consulta_inscritos->execute();
			$inscritos = $consulta_inscritos->rowCount();

      
			$linha = $consulta->fetch(PDO::FETCH_ASSOC);
			$resposta["vagas"] = $linha["max_pessoas"] - $inscritos;
			$resposta["sucesso"] = 1;
			
		} else {
			// Caso o produto nao exista no BD, o cliente 
			// recebe a chave "sucesso" com valor 0. A chave "erro" indica o 
			// motivo da falha.
			$resposta["sucesso"] = 0;
			$resposta["erro"] = "Evento não encontrado";
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
