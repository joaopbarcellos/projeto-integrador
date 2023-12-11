<?php

/*
 * O codigo seguinte retorna os dados detalhados de um produto.
 * Essa e uma requisicao do tipo GET. Um produto e identificado 
 * pelo campo id.
 */

// conexão com bd
require_once('conexao_db.php');
require_once('pegar_endereco.php');
require_once('pegar_intuito.php');
require_once('pegar_classificacao.php');
require_once('pegar_publico_alvo.php');


// array de resposta
$resposta = array();


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



			$resposta["intuito"] = pegarIntuito($db_con, $intuito);

			$consulta_usuario = $db_con->prepare("SELECT nome FROM usuario WHERE id = " . $usuario);
			$consulta_usuario->execute();
			$linha_usuario = $consulta_usuario->fetch(PDO::FETCH_ASSOC);

			$resposta["usuario"] = $linha_usuario["nome"];

			$resposta["idade_publico"] = pegarPublicoAlvo($db_con, $idade_publico);

			$resposta["endereco"] = pegarEndereco($db_con, $endereco);

			$resposta["classificacao"] = pegarClassificacao($db_con, $classificacao);

			// Caso o produto exista no BD, o cliente 
			// recebe a chave "sucesso" com valor 1.
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
