<?php 
require_once("conexao_db.php");

if (isset($_GET["id_evento"])) {
    $id_evento = $_GET["id_evento"];
    $deletar = $db_con->prepare("DELETE FROM evento WHERE id=$id_evento");
    $deletar->execute();
    $db_con = null;
}

header("Location: ../myevents.php");
?>