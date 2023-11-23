<?php
// esse arquivo CRIA a inscricao de um
// usuario no banco de dados

require_once("conexao_db.php");

// array de resposta
$resposta = array();
session_start();


if (isset($_GET['id'])){
    $id_evento = $_GET['id'];
    $email = $_SESSION["logado"];

    $consultaEmail = $db_con->prepare("SELECT * FROM usuario WHERE email='$email'");
    $consultaEmail->execute();
    $linha = $consultaEmail->fetch(PDO::FETCH_ASSOC);
    
    $id_logado = $linha['id'];

    $consulta = $db_con->prepare("INSERT INTO usuario_evento (fk_usuario_id, fk_evento_id) values ($id_logado, $id_evento)");
	$consulta->execute();
    header("location: ../evento.php?id_evento=$id_evento");
}

// Fecha a conexao com o BD
$db_con = null;
?>