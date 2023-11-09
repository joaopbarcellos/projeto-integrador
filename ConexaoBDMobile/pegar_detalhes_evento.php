<?php

/*
 * O codigo seguinte retorna os dados detalhados de um produto.
 * Essa e uma requisicao do tipo GET. Um produto e identificado 
 * pelo campo id.
 */

// conexão com bd
require_once('conexao_db.php');

// autenticação
require_once('autenticacao.php');

// array de resposta
$resposta = array();

// verifica se o usuário conseguiu autenticar
if(autenticar($db_con)) {

	// Verifica se o parametro id foi enviado na requisicao
	if (isset($_GET["id"])) {
		
		// Aqui sao obtidos os parametros
		$id = $_GET['id'];
		
		// Obtem do BD os detalhes do produto com id especificado na requisicao GET
		$consulta = $db_con->prepare("SELECT * FROM evento WHERE id = $id");
	
		if ($consulta->execute()) {
			if ($consulta->rowCount() > 0) {
	
				// Se o produto existe, os dados completos do produto 
				// sao adicionados no array de resposta. A imagem nao 
				// e entregue agora pois ha um php exclusivo para obter 
				// a imagem do produto.
				$linha = $consulta->fetch(PDO::FETCH_ASSOC);
				$resposta["nome"] = $linha["nome"];
				$resposta["preco"] = $linha["preco"];
				$resposta["descricao"] = $linha["descricao"];
				$resposta["data"] = $linha["data"];
				$resposta["foto"] = $linha["foto"];
				$resposta["max_pessoas"] = $linha["max_pessoas"];
				$resposta["min_pessoas"] = $linha["min_pessoas"];
				$resposta["horario_inicio"] = $linha["horario_inicio"];
				$resposta["horario_fim"] = $linha["horario_fim"];
				$intuito = $linha["fk_intuito_id"];
				$endereco = $linha["fk_endereco_id"];
				$usuario = $linha["fk_usuario_id"];
				$idade_publico = $linha["fk_idade_publico_id"];
				$classificacao = $linha["fk_classificacao_id"];


				$consulta_intuito = $db_con->prepare("SELECT nome FROM intuito WHERE id = " . $intuito);
				$consulta_intuito->execute();
				$linha_intuito = $consulta_intuito->fetch(PDO::FETCH_ASSOC);

				$resposta["intuito"] = $linha_intuito["nome"];

				$consulta_usuario = $db_con->prepare("SELECT nome FROM usuario WHERE id = " . $usuario);
				$consulta_usuario->execute();
				$linha_usuario = $consulta_usuario->fetch(PDO::FETCH_ASSOC);

				$resposta["usuario"] = $linha_usuario["nome"];

				$consulta_idade_publico = $db_con->prepare("SELECT intervalo FROM idade_publico WHERE id = " . $idade_publico);
				$consulta_idade_publico->execute();
				$linha_idade_publico = $consulta_idade_publico->fetch(PDO::FETCH_ASSOC);

				$resposta["idade_publico"] = $linha_idade_publico["intervalo"];

				$consulta_endereco = $db_con->prepare("SELECT * FROM endereco WHERE id = " . $endereco);
				$consulta_endereco->execute();
				$linha_endereco = $consulta_endereco->fetch(PDO::FETCH_ASSOC);

				$resposta["endereco"] = $linha_endereco["descricao"];

				$consulta_classificacao = $db_con->prepare("SELECT nome FROM classificacao WHERE id = " . $classificacao);
				$consulta_classificacao->execute();
				$linha_classificacao = $consulta_classificacao->fetch(PDO::FETCH_ASSOC);

				$resposta["classificacao"] = $linha_classificacao["nome"];

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
}
else {
	// senha ou usuario nao confere
	$resposta["sucesso"] = 0;
	$resposta["error"] = "usuario ou senha não confere";
}
// Fecha a conexao com o BD
$db_con = null;

// Converte a resposta para o formato JSON.
echo json_encode($resposta);
?>
