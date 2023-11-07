<?php

/*
 * O seguinte codigo retorna para o cliente a lista de eventos 
 * armazenados no servidor. Essa e uma requisicao do tipo GET. 
 * Devem ser enviados os parâmetro de limit e offset para 
 * realização da paginação de dados no cliente.
 * A resposta e no formato JSON.
 */

// conexão com bd
require_once('conexao_db.php');

// array for JSON resposta
$resposta = array();

// verifica se o usuário conseguiu autenticar
if($db_con) {
	
	// Primeiro, verifica-se se todos os parametros foram enviados pelo cliente.
	// limit - quantidade de eventos a ser entregues
	// offset - indica a partir de qual evento começa a lista
	$limit = 20;
	if (true) {

		// Realiza uma consulta ao BD e obtem todos os eventos.
		$consulta = $db_con->prepare("SELECT * FROM evento LIMIT " . $limit);

		if($consulta->execute()) {
			// Caso existam eventos no BD, eles sao armazenados na 
			// chave "eventos". O valor dessa chave e formado por um 
			// array onde cada elemento e um evento.
			$resposta["eventos"] = array();
			$resposta["sucesso"] = 1;

			if ($consulta->rowCount() > 0) {
				while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
					// Para cada evento, sao retornados somente o 
					// pid (id do evento), o nome do evento e o preço. Nao ha necessidade 
					// de retornar nesse momento todos os campos dos eventos 
					// pois a app cliente, inicialmente, so precisa do nome e preço do mesmo para 
					// exibir na lista de eventos. O campo id e usado pela app cliente 
					// para buscar os detalhes de um evento especifico quando o usuario 
					// o seleciona. Esse tipo de estrategia poupa banda de rede, uma vez 
					// os detalhes de um evento somente serao transferidos ao cliente 
					// em caso de real interesse.
					$evento = array();
					
					
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

					$consulta_intuito = $db_con->prepare("SELECT nome FROM intuito WHERE id = " . $linha["fk_intuito_id"]);
					$consulta_intuito->execute();
					$linha_intuito = $consulta_intuito->fetch(PDO::FETCH_ASSOC);

					$consulta_idade_publico = $db_con->prepare("SELECT intervalo FROM idade_publico WHERE id = " . $linha["fk_idade_publico_id"]);
					$consulta_idade_publico->execute();
					$linha_idade_publico = $consulta_idade_publico->fetch(PDO::FETCH_ASSOC);

					$consulta_endereco = $db_con->prepare("SELECT * FROM endereco WHERE id = " . $linha["fk_endereco_id"]);
					$consulta_endereco->execute();
					$linha_endereco = $consulta_endereco->fetch(PDO::FETCH_ASSOC);

					$consulta_bairro = $db_con->prepare("SELECT * FROM bairro WHERE id = " . $linha_endereco["fk_bairro_id"]);
					$consulta_bairro->execute();
					$linha_bairro = $consulta_bairro->fetch(PDO::FETCH_ASSOC);

					$consulta_cidade = $db_con->prepare("SELECT * FROM cidade WHERE id = " . $linha_bairro["fk_cidade_id"]);
					$consulta_cidade->execute();
					$linha_cidade = $consulta_cidade->fetch(PDO::FETCH_ASSOC);

					$consulta_estado = $db_con->prepare("SELECT nome FROM estado WHERE id = " . $linha_cidade["fk_estado_id"]);
					$consulta_estado->execute();
					$linha_estado = $consulta_estado->fetch(PDO::FETCH_ASSOC);

					$evento["classificacao"] = $linha_classificacao["nome"];
					$evento["nome"] = $linha["nome"];
					$evento["preco"] = number_format($linha["preco"], 2, ',', '');
					$evento["data"] = $linha["data"];
					$evento["min_pessoas"] = $linha["min_pessoas"];
					$evento["max_pessoas"] = $linha["max_pessoas"];
					$evento["horario_fim"] = $linha["horario_fim"];
					$evento["horario_inicio"] = $linha["horario_inicio"];
					$evento["intuito"] = $linha_intuito["nome"];
					$evento["endereco"] = $linha_endereco["descricao"] . ", " . $linha_endereco["numero"] . " - " . $linha_bairro["nome"] . ", " . $linha_cidade["nome"] . " - " . $linha_estado["nome"] . ", " . $linha_endereco["cep"];
					$evento["idade_publico"] = $linha_idade_publico["intervalo"];

					// Adiciona o evento no array de eventos.
					array_push($resposta["eventos"], $evento);
				}
			}
		}
		else {
			// Caso ocorra falha no BD, o cliente 
			// recebe a chave "sucesso" com valor 0. A chave "erro" indica o 
			// motivo da falha.
			$resposta["sucesso"] = 0;
			$resposta["erro"] = "Erro no BD: " . $consulta->$error;
		}
	}
	else {
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
	$resposta["erro"] = "usuario ou senha não confere";
}

// fecha conexão com o bd
$db_con = null;

// Converte a resposta para o formato JSON.
return json_encode($resposta);
?>