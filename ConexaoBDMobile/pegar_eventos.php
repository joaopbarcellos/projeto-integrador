<?php

/*
 * O seguinte codigo retorna para o cliente a lista de produtos 
 * armazenados no servidor. Essa e uma requisicao do tipo GET. 
 * Devem ser enviados os parâmetro de limit e offset para 
 * realização da paginação de dados no cliente.
 * A resposta e no formato JSON.
 */

// conexão com bd
require_once('conexao_db.php');

// array for JSON resposta
$resposta = array();
$resposta["eventos"] = array();
// Primeiro, verifica-se se todos os parametros foram enviados pelo cliente.
// limit - quantidade de produtos a ser entregues
// offset - indica a partir de qual produto começa a lista
if (isset($_GET['limit']) && isset($_GET['offset'])) {

	$limit = $_GET['limit'];
	$offset = $_GET['offset'];

	// Realiza uma consulta ao BD e obtem todos os produtos.
	$consulta = $db_con->prepare("SELECT * FROM evento LIMIT " . $limit . " OFFSET " . $offset);
	$consulta->execute();
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
				$evento["foto"] = $linha["foto"];

				$evento["nome"] = $linha["nome"];
				$evento["preco"] = number_format($linha["preco"], 2, ',', '');
				$evento["data"] = $linha["data"];
				$evento["horario_fim"] = $linha["horario_fim"];
				$evento["horario_inicio"] = $linha["horario_inicio"];

				// Adiciona o evento no array de eventos.
				array_push($resposta["eventos"], $evento);
			}
		$resposta["sucesso"] = 1;
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

// fecha conexão com o bd
$db_con = null;

// Converte a resposta para o formato JSON.
echo json_encode($resposta);
?>
