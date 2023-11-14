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

require_once('Carregar/carregar_endereco_evento.php');

require_once('Carregar/carregar_intuito.php');
require_once('Carregar/carregar_classificacao.php');

require_once('Carregar/carregar_intervalo.php');

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
				$evento["id"] = $linha["id"];

				$evento["classificacao"] = carregar_classificacao($db_con, $linha["fk_classificacao_id"]);

				$evento["idade_publico"] = carregar_intervalo($db_con, $linha["fk_idade_publico_id"]);

				$consulta_usuario = $db_con->prepare("SELECT * FROM usuario WHERE id = " . $linha["fk_usuario_id"]);
				$consulta_usuario->execute();
				$linha_usuario = $consulta_usuario->fetch(PDO::FETCH_ASSOC);

				$consulta_inscritos = $db_con->prepare("SELECT * FROM usuario_evento WHERE fk_evento_id = " . $evento["id"]);
				$consulta_inscritos->execute();
				$evento["inscritos"] = $consulta_inscritos->rowCount();
				
				$evento["nome"] = $linha["nome"];
				$evento["preco"] = $linha["preco"];
				$evento["descricao"] = $linha["descricao"];
				$evento["data"] = $linha["data"];
				$evento["telefone"] = $linha["telefone"];
				// $evento["min_pessoas"] = $linha["min_pessoas"];
				// $evento["max_pessoas"] = $linha["max_pessoas"];
				$evento["vagas_restantes"] = $linha["max_pessoas"] - $evento["inscritos"];
				$evento["horario_inicio"] = $linha["horario_inicio"];
				$evento["horario_fim"] = $linha["horario_fim"];
				$evento["usuario"] = $linha_usuario["nome"];
				$evento["contato"] = $linha_usuario["telefone"];
				$evento["foto"] = $linha["foto"];
				$evento["intuito"] = carregar_intuito($db_con, $linha["fk_intuito_id"]);
				$evento["endereco"] = carregar_endereco($db_con, $linha["fk_endereco_id"]);
					

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