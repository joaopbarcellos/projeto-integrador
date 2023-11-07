<?php

require_once('conexao_db.php');
require_once('autenticacao.php');
session_start();

$resposta = array();
function carregar_usuario($db_con){
    $email_logado = $_SESSION["logado"];
    $consulta_usuario = $db_con->prepare("SELECT id FROM usuario WHERE email='$email_logado'");
    
    $linha_endereco = $consulta_usuario->fetch(PDO::FETCH_ASSOC);
    $resposta["sucesso"] = 1;
    $resposta["erro"] = 0;
    $resposta["id"] = $linha_endereco["id"];
    return $resposta["id"];
}
?>