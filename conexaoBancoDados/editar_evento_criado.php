<?php
session_start();
require_once('conexao_db.php');
// array de resposta
ini_set('display_errors', 1);
$resposta = array();

if (isset($_POST["nome"]) && isset($_POST["min_pessoas"]) && isset($_POST["max_pessoas"]) && isset($_POST["descricao"]) && isset($_SESSION["evento_atual"])) {
    $nome = $_POST["nome"];
    $min = $_POST["min_pessoas"];
    $max = $_POST["max_pessoas"];
    $desc = $_POST["descricao"];
    $id = $_SESSION["evento_atual"];
    
    $edicao = $db_con->prepare("UPDATE evento SET nome = '$nome', min_pessoas = $min, max_pessoas = $max, descricao = '$desc'  WHERE id = $id");
    $edicao->execute();
    $db_con = null;
    header("Location: ../evento.php?id_evento=$id");
}
?>