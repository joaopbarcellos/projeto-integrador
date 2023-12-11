<?php
// esse arquivo CONSULTA os eventos que devem
// aparecer na pagina inicial

// conexão com bd
require_once('conexao_db.php');

// array for JSON resposta
$resposta = array();
$resposta["eventos"] = array();

// verifica se o usuário conseguiu autenticar
if($db_con) {
	
    $limit = $_GET["limit"];
    $offset = $_GET["offset"];
	// Realiza uma consulta ao BD e obtem todos os eventos.
	$consulta_filtrado = $db_con->prepare("SELECT id FROM (SELECT e.id, (COUNT(ue.fk_evento_id) * 100 / e.max_pessoas) AS porcentagem FROM evento e LEFT JOIN usuario_evento ue ON ue.fk_evento_id = e.id GROUP BY e.id, e.max_pessoas) AS subquery WHERE porcentagem < 100 ORDER BY porcentagem DESC LIMIT " . $limit . " OFFSET " . $offset);

	$consulta_filtrado->execute();
	if ($consulta_filtrado->rowCount() > 0) {
		while ($linha_filtro = $consulta_filtrado->fetch(PDO::FETCH_ASSOC)) {
			$id_evento = $linha_filtro["id"];
			$consulta = $db_con->prepare("SELECT * FROM evento WHERE evento.id = $id_evento");
			$consulta->execute();
			$linha = $consulta->fetch(PDO::FETCH_ASSOC);
			$evento = array();
			
			$evento["id"] = $linha["id"];
			


			$evento["nome"] = $linha["nome"];
			$evento["preco"] = number_format($linha["preco"], 2, ',', '');
			$evento["data"] = $linha["data"];
			$evento["horario_fim"] = $linha["horario_fim"];
			$evento["horario_inicio"] = $linha["horario_inicio"];
			$evento["foto"] = $linha["foto"];

			// Adiciona o evento no array de eventos.
			array_push($resposta["eventos"], $evento);
		}
        $resposta["sucesso"] = 1;
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
echo json_encode($resposta);
?>