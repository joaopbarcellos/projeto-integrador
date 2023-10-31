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
				$evento["id"] = $linha["id"];
	
				$consulta_foto_evento = $db_con->prepare("SELECT foto FROM foto_evento WHERE fk_evento_id = " . $evento["id"]);
				$consulta_foto_evento->execute();
				$linha_foto_evento = $consulta_foto_evento->fetch(PDO::FETCH_ASSOC);
				$evento["foto"] = $linha_foto_evento["foto"];

				$consulta_evento_classificacao = $db_con->prepare("SELECT fk_classificacao_id FROM evento_classificacao WHERE fk_evento_id = " . $evento["id"]);
				$consulta_evento_classificacao->execute();
				$linha_evento_classificacao = $consulta_evento_classificacao->fetch(PDO::FETCH_ASSOC);

				$consulta_classificacao = $db_con->prepare("SELECT nome FROM classificacao WHERE id = " . $linha_evento_classificacao["fk_classificacao_id"]);
				$consulta_classificacao->execute();
				$linha_classificacao = $consulta_classificacao->fetch(PDO::FETCH_ASSOC);
				$evento["classificacao"] = $linha_classificacao["nome"];

				$consulta_intuito = $db_con->prepare("SELECT nome FROM intuito WHERE id = " . $linha["fk_intuito_id"]);
				$consulta_intuito->execute();
				$linha_intuito = $consulta_intuito->fetch(PDO::FETCH_ASSOC);
				$evento["intuito"] = $linha_intuito["nome"];

				$consulta_idade_publico = $db_con->prepare("SELECT intervalo FROM idade_publico WHERE id = " . $linha["fk_idade_publico_id"]);
				$consulta_idade_publico->execute();
				$linha_idade_publico = $consulta_idade_publico->fetch(PDO::FETCH_ASSOC);
				$evento["intervalo"] = $linha_idade_publico["intervalo"];

				$consulta_endereco = $db_con->prepare("SELECT * FROM endereco WHERE id = " . $linha["fk_endereco_id"]);
				$consulta_endereco->execute();
				$linha_endereco = $consulta_endereco->fetch(PDO::FETCH_ASSOC);
				
				$consulta_tipo_logradouro = $db_con->prepare("SELECT tipo FROM tipo_logradouro WHERE id = ". $linha_endereco["fk_tipo_logradouro_id"]);
				$consulta_tipo_logradouro->execute();
				$linha_tipo_logradouro = $consulta_tipo_logradouro->fetch(PDO::FETCH_ASSOC);

				$consulta_bairro = $db_con->prepare("SELECT * FROM bairro WHERE id = " . $linha_endereco["fk_bairro_id"]);
				$consulta_bairro->execute();
				$linha_bairro = $consulta_bairro->fetch(PDO::FETCH_ASSOC);

				$consulta_cidade = $db_con->prepare("SELECT * FROM cidade WHERE id = " . $linha_bairro["fk_cidade_id"]);
				$consulta_cidade->execute();
				$linha_cidade = $consulta_cidade->fetch(PDO::FETCH_ASSOC);

				$consulta_estado = $db_con->prepare("SELECT nome FROM estado WHERE id = " . $linha_cidade["fk_estado_id"]);
				$consulta_estado->execute();
				$linha_estado = $consulta_estado->fetch(PDO::FETCH_ASSOC);

				$consulta_usuario = $db_con->prepare("SELECT nome FROM usuario WHERE id = " . $linha["fk_usuario_id"]);
				$consulta_usuario->execute();
				$linha_usuario = $consulta_usuario->fetch(PDO::FETCH_ASSOC);

				$evento["nome"] = $linha["nome"];
				$evento["preco"] = $linha["preco"];
				$evento["descricao"] = $linha["descricao"];
				$evento["data"] = $linha["data"];
				$evento["telefone"] = $linha["telefone"];
				$evento["min_pessoas"] = $linha["min_pessoas"];
				$evento["max_pessoas"] = $linha["max_pessoas"];
				$evento["horario_inicio"] = $linha["horario_inicio"];
				$evento["horario_fim"] = $linha["horario_fim"];
				$evento["usuario"] = $linha_usuario["nome"];
				$evento["endereco"] = $linha_tipo_logradouro["tipo"] . " " . $linha_endereco["descricao"] . ", " . $linha_endereco["numero"] . " - " . $linha_bairro["nome"] . ", " . $linha_cidade["nome"] . " - " . $linha_estado["nome"] . ", " . $linha_endereco["cep"];
					

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