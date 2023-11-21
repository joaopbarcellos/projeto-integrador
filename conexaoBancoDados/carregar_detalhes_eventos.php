<?php
// conexão com bd
require_once('conexao_db.php');

// autenticação
require_once('autenticacao.php');

// array de resposta
$resposta = array();

// Verifica se o parametro id foi enviado na requisicao
if (isset($_SESSION["evento_atual"])) {
	
	// Aqui sao obtidos os parametros
	$id = $_SESSION["evento_atual"];
	
	// Obtem do BD os detalhes do produto com id especificado na requisicao GET
	$consulta = $db_con->prepare("SELECT * FROM evento WHERE id = $id");

	if ($consulta->execute()) {
		if ($consulta->rowCount() > 0) {
			$linha = $consulta->fetch(PDO::FETCH_ASSOC);
			$evento["id"] = $linha["id"];

			$consulta_usuario = $db_con->prepare("SELECT * FROM usuario WHERE id = " . $linha["fk_usuario_id"]);
			$consulta_usuario->execute();
			$linha_usuario = $consulta_usuario->fetch(PDO::FETCH_ASSOC);

			$consulta_inscritos = $db_con->prepare("SELECT * FROM usuario_evento WHERE fk_evento_id = " . $evento["id"]);
			$consulta_inscritos->execute();
			$evento["inscritos"] = $consulta_inscritos->rowCount();
			$evento["nome"] = $linha["nome"];
			if($linha["preco"] == 0) {
				$evento["preco"] = "Gratuito";
			} else {
				$evento["preco"] = $linha["preco"];
			}
			$evento["descricao"] = $linha["descricao"];
			$evento["data"] = $linha["data"];
			// $evento["min_pessoas"] = $linha["min_pessoas"];
			// $evento["max_pessoas"] = $linha["max_pessoas"];
			$evento["vagas_restantes"] = $linha["max_pessoas"] - $evento["inscritos"];
			$evento["horario_inicio"] = $linha["horario_inicio"];
			$evento["horario_fim"] = $linha["horario_fim"];
			$evento["usuario"] = $linha_usuario["nome"];
			$evento["contato"] = $linha_usuario["telefone"];
			$evento["foto"] = $linha["foto"];
			$evento["id_classificacao"] = $linha["fk_classificacao_id"];
			$evento["id_endereco"] = $linha["fk_endereco_id"];
			$evento["id_idade_publico"] = $linha["fk_idade_publico_id"];
			$evento["id_intuito"] = $linha["fk_intuito_id"];
				

			// Caso o produto exista no BD, o cliente 
			// recebe a chave "sucesso" com valor 1.
			$resposta["sucesso"] = 1;
			
		} else {
			// Caso o produto nao exista no BD, o cliente 
			// recebe a chave "sucesso" com valor 0. A chave "erro" indica o 
			// motivo da falha.
			$resposta["sucesso"] = 0;
			$resposta["erro"] = "Produto não encontrado";
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

// Converte a resposta para o formato JSON.
return json_encode($evento);
?>