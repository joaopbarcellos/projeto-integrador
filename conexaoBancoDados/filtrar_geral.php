<?php
require_once("conexao_db.php");
require_once('Carregar/carregar_endereco_evento.php');
require_once('Carregar/carregar_intuito.php');
require_once('Carregar/carregar_classificacao.php');
require_once('Carregar/carregar_intervalo.php');

$resposta = array();
$resposta["eventos"] = array();
$condicoes = array();

session_start();

$codigo_sql = "SELECT * FROM evento WHERE ";

if (isset($_POST["preco"])){
    $condicoes[] = "preco <= " . $_POST["preco"];
}

if (isset($_POST["idade"])){
    $condicoes[] = "fk_idade_publico_id = " . $_POST["idade"];
}

if (isset($_POST["intuito"])){
    $condicoes[] = "fk_intuito_id = " . $_POST["intuito"];

}

if (isset($_POST["horario_inicio"])){
    $condicoes[] = "horario_inicio = " . $_POST["horario_inicio"];
}

if (isset($_POST["horario_fim"])){
    $condicoes[] = "horario_fim = " . $_POST["horario_fim"];
}

if (isset($_POST["data"])){
    $condicoes[] = "data = " . $_POST["data"];

}

if (isset($_POST["esporte"])){
    $condicoes[] = "fk_classificacao_id = " . $_POST["esporte"];
    
}

if (!empty($condicoes)) {
    $codigo_sql .= implode(" AND ", $condicoes);
} else {
    $codigo_sql .= "1"; // Se nenhum filtro for aplicado, retorna todos os registros
}

$db_con = null;
$_SESSION["filtro"] = json_encode($resposta);
header("Location: ../index.php?filtro='Filtro personalizado'")
?>