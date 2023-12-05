<?php
require_once("conexao_db.php");
require_once('Carregar/carregar_endereco_evento.php');
require_once('Carregar/carregar_intuito.php');
require_once('Carregar/carregar_classificacao.php');
require_once('Carregar/carregar_intervalo.php');

$resposta = array();
$resposta["eventos"] = array();
$condicoes = array();
ini_set('display_errors', 1);
session_start();

$codigo_sql = "SELECT * FROM evento WHERE ";

if (isset($_SESSION["filtro_esporte"])){
    if ($_SESSION["filtro_esporte"] != 0) $condicoes[] = "fk_classificacao_id = " . $_SESSION["filtro_esporte"];
}

if (isset($_POST["idade"])){
    $_SESSION["filtro_idade"] = $_POST["idade"];
    if($_POST["idade"] != 0) $condicoes[] = "fk_idade_publico_id = " . $_POST["idade"];
}

if (isset($_POST["intuito"])){
    $_SESSION["filtro_intuito"] = $_POST["intuito"];
    if($_POST["intuito"] != 0) $condicoes[] = "fk_intuito_id = " . $_POST["intuito"];
}

if (isset($_POST["gratuito"])){
    $_SESSION["filtro_gratuito"] = $_POST["gratuito"];
    $condicoes[] = "preco = " . 0;
} else if (isset($_POST["preco"])){
    unset($_SESSION['filtro_gratuito']);
    $_SESSION["filtro_preco"] = $_POST["preco"];
    if ($_POST["preco"]) $condicoes[] = "preco <= " . $_POST["preco"];
}

if (isset($_POST["turno"])){
    $_SESSION["filtro_turno"] = $_POST["turno"];
    if($_POST["turno"] == 1) $condicoes[] = "horario_inicio < '12:00:00' AND horario_inicio >= '00:00:00'";
    if($_POST["turno"] == 2) $condicoes[] = "horario_inicio < '18:00:00' AND horario_inicio >= '12:00:00'";
    if($_POST["turno"] == 3) $condicoes[] = "horario_inicio <= '23:59:99' AND horario_inicio >= '18:00:00'";
}

if (isset($_POST["data1"])){
    $_SESSION["filtro_data1"] = $_POST["data1"];
    if ($_POST["data1"] != "") $condicoes[] = "data > '" . $_POST["data1"]."'";
}

if (isset($_POST["data2"])){
    $_SESSION["filtro_data2"] = $_POST["data2"];
    if ($_POST["data2"] != "") $condicoes[] = "data < '" . $_POST["data2"] ."'";
}

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
        array_push($resposta["eventos"], $evento);
    }
}

$db_con = null;
$_SESSION["filtro"] = json_encode($resposta);
header("Location: ../index.php?filtro=")
?>