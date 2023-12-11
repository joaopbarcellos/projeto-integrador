<?php
require_once("conexao_db.php");

$email = $_GET["email"];
$senha_antiga = trim($_GET["senha_antiga"]);
$senha_nova = trim($_GET["senha_nova"]);

$consulta_usuario = $db_con->prepare("SELECT * from usuario where email = '$email'");
$consulta_usuario->execute();
$senha_salva = $consulta_usuario->fetch(PDO::FETCH_ASSOC)["token"];

$resposta = array();
if(password_verify($senha_antiga, $senha_salva)){
    $token = password_hash($senha_nova, PASSWORD_DEFAULT);
    $consulta = $db_con->prepare("UPDATE usuario set token = '$token' where email = '$email'");
    if($consulta->execute()){
        $resposta["sucesso"] = 1;
    } else {
        $resposta["sucesso"] = 0;
        $resposta["erro"] = "Erro no Banco de Dados = " . $consulta->$error;
    }
}else{
    $resposta["sucesso"] = 0;
    $resposta["erro"] = "O campo de senha antiga está errado.";
}

$db_con = null;
echo json_encode($resposta);
?>
