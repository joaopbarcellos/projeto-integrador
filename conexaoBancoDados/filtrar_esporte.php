<?php
require_once("conexao_db.php");
require_once('Carregar/carregar_endereco_evento.php');
require_once('Carregar/carregar_intuito.php');
require_once('Carregar/carregar_classificacao.php');
require_once('Carregar/carregar_intervalo.php');

$resposta = array();
$resposta["eventos"] = array();
session_start();

ini_set('display_errors', 1);
if (isset($_SESSION["filtro_personalizado"]) && isset($_POST["esporte"])){
	$condicoes = array();
	$codigo_sql = "SELECT * FROM evento WHERE ";

	$esporte = trim($_POST["esporte"]);
	
    $consulta_esporte = $db_con->prepare("SELECT id FROM classificacao WHERE nome='$esporte'");
    $consulta_esporte->execute();

    $linha_esporte = $consulta_esporte->fetch(PDO::FETCH_ASSOC);
    $id_esporte = $linha_esporte["id"];
	$_SESSION["filtro_esporte_nome"] = $esporte;
	$_SESSION["filtro_esporte_id"] = $id_esporte;

	$condicoes[] = "fk_classificacao_id = $id_esporte";

	if (isset($_SESSION["filtro_idade"])){
		if($_SESSION["filtro_idade"] != 0) $condicoes[] = "fk_idade_publico_id = " . $_SESSION["filtro_idade"];
	}

	if (isset($_SESSION["filtro_intuito"])){
		if($_SESSION["filtro_intuito"] != 0) $condicoes[] = "fk_intuito_id = " . $_SESSION["filtro_intuito"];
	}

	if (isset($_SESSION["filtro_gratuito"])){
		$condicoes[] = "preco = " . 0;
	} else if (isset($_SESSION["filtro_preco"])){
		unset($_SESSION['filtro_gratuito']);
		if ($_SESSION['filtro_gratuito']) $condicoes[] = "preco <= " . $_SESSION['filtro_gratuito'];
	}

	if (isset($_SESSION["filtro_turno"])){
		if($_SESSION["filtro_turno"] == 1) $condicoes[] = "horario_inicio < '12:00:00' AND horario_inicio >= '00:00:00'";
		if($_SESSION["filtro_turno"] == 2) $condicoes[] = "horario_inicio < '18:00:00' AND horario_inicio >= '12:00:00'";
		if($_SESSION["filtro_turno"] == 3) $condicoes[] = "horario_inicio <= '23:59:59' AND horario_inicio >= '18:00:00'";
	}

	if (isset($_SESSION["filtro_data1"])){
		if ($_SESSION["filtro_data1"] != "") $condicoes[] = "data > '" . $_SESSION["filtro_data1"]."'";
	}

	if (isset($_SESSION["filtro_data2"])){
		if ($_SESSION["filtro_data2"] != "") $condicoes[] = "data < '" . $_SESSION["filtro_data2"] ."'";
	}
	var_dump($condicoes);
	if (!empty($condicoes)) {
		$codigo_sql .= implode(" AND ", $condicoes);
	} else {
		$codigo_sql .= "true"; // Se nenhum filtro for aplicado, retorna todos os registros
	}

	$codigo_sql .= " ORDER BY preco";

	$consulta_filtrado = $db_con->prepare($codigo_sql);
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
			array_push($resposta['eventos'], $evento);
		}
	}
	$db_con = null;
	$_SESSION["filtro"] = json_encode($resposta);
	$_SESSION["filtro_personalizado"] = "feito"; 
	header("Location: ../index.php?filtro=");
} else if (isset($_POST["esporte"])){
    $esporte = trim($_POST["esporte"]);
	
    $consulta_esporte = $db_con->prepare("SELECT id FROM classificacao WHERE nome='$esporte'");
    $consulta_esporte->execute();

    $linha_esporte = $consulta_esporte->fetch(PDO::FETCH_ASSOC);
    $id_esporte = $linha_esporte["id"];
	$_SESSION["filtro_esporte_nome"] = $esporte;
	$_SESSION["filtro_esporte_id"] = $id_esporte;

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

    $_SESSION["filtro"] = json_encode($resposta);
	header("Location: ../index.php?filtro=$esporte");
}
?>