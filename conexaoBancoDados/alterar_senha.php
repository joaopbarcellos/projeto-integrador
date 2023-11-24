<?php
// esse arquivo CONSULTA se o usuario acertou a senha
// e ALTERA/EDITA no banco de dados a senha nova

require_once("conexao_db.php");
$resposta = array();

if (isset($_POST["senhaAntigaCampo"]) && isset($_POST["senhaCampo"]) && isset($_POST["confSenhaCampo"])) {
    $senha_antiga = trim($_POST["senhaAntigaCampo"]);
    $senha = trim($_POST["senhaCampo"]);
    $confirmar = trim($_POST["senhaCampo"]);

    if ($senha == $confirmar){
        $email = $_SESSION["logado"];
        $consultaEmail = $db_con->prepare("SELECT * FROM usuario WHERE email='$email'");
        $consultaEmail->execute();
        $linha_usuario = $consultaEmail->fetch(PDO::FETCH_ASSOC);
        $id_logado = $linha_usuario['id'];

        if(password_verify($senha_antiga, $linha_usuario['token'])) {
            $token = password_hash($senha, PASSWORD_DEFAULT);
            $alterar = $db_con->prepare("UPDATE usuario SET token='$token' WHERE id='$id_logado'");
            header("Location : ../perfil.php");
        } else {
            $resposta["erro"] = "Senha antiga errada!";
        }
    } else {
        $resposta["erro"] = "Senha e confirmar senha diferentes!";
    }
} else {
    $resposta["erro"] = "Campos requeridos nao preenchidos";
}

return $resposta["erro"];
?>