<?php
require_once("conexao_db.php");

// array de resposta
$resposta = array();
session_start();

if(isset($_POST["emailCampo"]) && isset($_POST["senhaCampo"])) {
	$emailLogin = strtolower(trim($_POST["emailCampo"]));
	$senhaLogin = trim($_POST["senhaCampo"]);

	// realiza a consula no bd pelo usuário login
	$consulta = $db_con->prepare("SELECT token FROM usuario WHERE email='$emailLogin'");
	$consulta->execute();

	// caso o usuário exista, obtem-se o token de autenticação e 
	// o verifica junto a senha enviada ao servidor
	if($consulta->rowCount() > 0){
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
		if($linha['token'] == $senhaLogin){
			$_SESSION["logado"] = $emailLogin;
			require_once("carregar_detalhes_logado.php");
			header("location: ../index.php");
		} else {
			header("location: ../login.php?erroLogin=Credenciais inválidas");
		}
	} else {
		header("location: ../login.php?erroLogin=Credenciais inválidas");
	}
}

// Fecha a conexao com o BD
$db_con = null;
?>