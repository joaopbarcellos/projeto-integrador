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

require_once('Carregar/carregar_endereco_evento.php');

require_once('Carregar/carregar_intuito.php');
require_once('Carregar/carregar_classificacao.php');

require_once('Carregar/carregar_intervalo.php');
// array for JSON resposta
$resposta = array();
$resposta["eventos"] = array();

// verifica se o usuário conseguiu autenticar
if($db_con) {
	$limit = 10;
	
	// Realiza uma consulta ao BD e obtem todos os eventos.
	$consulta_filtrado = $db_con->prepare("SELECT id FROM (SELECT e.id, (COUNT(ue.fk_evento_id) * 100 / e.max_pessoas) AS porcentagem FROM evento e LEFT JOIN usuario_evento ue ON ue.fk_evento_id = e.id GROUP BY e.id, e.max_pessoas) AS subquery WHERE porcentagem < 100 ORDER BY porcentagem DESC LIMIT " . $limit);

	$consulta_filtrado->execute();
	if ($consulta_filtrado->rowCount() > 0) {
		while ($linha_filtro = $consulta_filtrado->fetch(PDO::FETCH_ASSOC)) {
			$id_evento = $linha_filtro["id"];
			$consulta = $db_con->prepare("SELECT * FROM evento WHERE evento.id = $id_evento");
			$consulta->execute();
			$linha = $consulta->fetch(PDO::FETCH_ASSOC);
			$evento = array();
			
			$evento["id"] = $linha["id"];
			

			$evento["idade_publico"] = carregar_intervalo($db_con, $linha["fk_idade_publico_id"]);

			$evento["classificacao"] = carregar_classificacao($db_con, $linha["fk_classificacao_id"]);
			$evento["nome"] = $linha["nome"];
			$evento["preco"] = number_format($linha["preco"], 2, ',', '');
			$evento["data"] = $linha["data"];
			$evento["horario_fim"] = $linha["horario_fim"];
			$evento["horario_inicio"] = $linha["horario_inicio"];
			$evento["intuito"] = carregar_intuito($db_con, $linha["fk_intuito_id"]);
			$evento["endereco"] = carregar_endereco($db_con, $linha["fk_endereco_id"]);
			$evento["foto"] = $linha["foto"];

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
		
	


// fecha conexão com o bd
$db_con = null;

// Converte a resposta para o formato JSON.
return json_encode($resposta);
?>