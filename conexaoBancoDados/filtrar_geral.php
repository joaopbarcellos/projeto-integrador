<?php
require_once("conexao_db.php");
require_once('Carregar/carregar_endereco_evento.php');
require_once('Carregar/carregar_intuito.php');
require_once('Carregar/carregar_classificacao.php');
require_once('Carregar/carregar_intervalo.php');

$resposta = array();
$resposta["eventos"] = array();

session_start();

$codigo_sql = "SELECT * FROM evento WHERE ";

if (isset($_POST["preco"])){
    // preco
    
}

if (isset($_POST["idade"])){
    // idade
    
}

if (isset($_POST["intuito"])){
    // intuito

}

if (isset($_POST["horario"])){
    // horario
    
}

if (isset($_POST["data"])){
    // data

}

if (isset($_POST["esporte"])){
    // esporte
    
}

$db_con = null;
$_SESSION["filtro"] = json_encode($resposta);
header("Location: ../index.php?filtro='Filtro personalizado'")
?>