<?php 
session_start();
require_once("conexao_db.php");
$emailLogin = $_SESSION["logado"];
$deletar = $db_con->prepare("DELETE FROM usuario WHERE email='$emailLogin'");
$deletar->execute();
$db_con = null;
session_unset();
session_destroy();
header("location: ../index.php")
?>
