<?php
require_once("conexao_db.php");
$resposta = array();
$resposta["eventos"] = array();

if (isset($_POST["esporte"])){
    $esporte = trim($_POST["esporte"]);
	var_dump($esporte);

    $consulta_esporte = $db_con->prepare("SELECT id FROM classificacao WHERE nome=$esporte");
    $consulta_esporte->execute();

    $linha_esporte = $consulta_esporte->fetch(PDO::FETCH_ASSOC);
    $id_esporte = $linha_esporte["id"];

    $consulta = $db_con->prepare("SELECT * FROM evento WHERE fk_classificacao_id=$id_esporte");
    $consulta->execute();

    if ($consulta->rowCount() > 0) {
		while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
			$id_evento = $linha["id"];
			$consulta_evento = $db_con->prepare("SELECT * FROM evento WHERE evento.id = $id_evento");
			$consulta_evento->execute();
			$linha_evento = $consulta_evento->fetch(PDO::FETCH_ASSOC);
			$evento = array();
			
			$evento["id"] = $linha_evento["id"];

			$evento["idade_publico"] = carregar_intervalo($db_con, $linha_evento["fk_idade_publico_id"]);

			$evento["classificacao"] = carregar_classificacao($db_con, $linha_evento["fk_classificacao_id"]);
			$evento["nome"] = $linha_evento["nome"];
			$evento["preco"] = number_format($linha_evento["preco"], 2, ',', '');
			$evento["data"] = $linha_evento["data"];
			$evento["horario_fim"] = $linha_evento["horario_fim"];
			$evento["horario_inicio"] = $linha_evento["horario_inicio"];
			$evento["intuito"] = carregar_intuito($db_con, $linha_evento["fk_intuito_id"]);
			$evento["endereco"] = carregar_endereco($db_con, $linha_evento["fk_endereco_id"]);
			$evento["foto"] = $linha_evento["foto"];

			array_push($resposta["eventos"], $evento);
		}
	}

    return json_encode($resposta);

}
?>