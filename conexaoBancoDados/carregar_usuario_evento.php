<?php

require_once('conexao_db.php');
require_once('autenticacao.php');
session_start();

$resposta = array();
function carregar_usuario($db_con){
    $email_logado = $_SESSION["logado"];
    $consulta_usuario = $db_con->prepare("SELECT * FROM usuario WHERE email='$email_logado'");
    $consulta_usuario->execute();
    
    $linha_usuario = $consulta_usuario->fetch(PDO::FETCH_ASSOC);
    $resposta["sucesso"] = 1;
    $resposta["erro"] = 0;
    $resposta["id"] = $linha_usuario["id"];
    return $resposta["id"];
}
?>