<?php
// esse arquivo aplica o DELETE no banco de dados
// de uma inscricao de um usuario em um evento

require_once("conexao_db.php");
if (isset($_GET['id'])){
    $id = $_GET['id'];
    session_start();

    $email = $_SESSION["logado"];

    $consultaEmail = $db_con->prepare("SELECT * FROM usuario WHERE email='$email'");
    $consultaEmail->execute();
    $linha_usuario = $consultaEmail->fetch(PDO::FETCH_ASSOC);
    $id_logado = $linha_usuario['id'];

    $deletar = $db_con->prepare("DELETE FROM usuario_evento WHERE fk_usuario_id=$id_logado and fk_evento_id=$id");
    $deletar->execute();

    header("location: ../myevents.php");

}
?>