<?php
require_once("conexao_db.php");

$resposta = array();
$resposta["eventos"] = array();
if(isset($_GET["id_esporte"]) && isset($_GET["limit"]) && isset($_GET["offset"])){
  $id_esporte = $_GET["id_esporte"];
  $limit = $_GET["limit"];
  $offset = $_GET["offset"];
  
  $consulta = $db_con->prepare("SELECT * FROM evento where fk_classificacao_id = '$id_esporte' LIMIT '$limit' OFFSET '$offset'");
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
}else{
  $resposta["sucesso"] = 0;
  $resposta["erro"] = "Campo requirido não preenchido";
}
$db_con = null;
echo json_encode($resposta);
?>
