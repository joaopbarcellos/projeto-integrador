<?php 
require_once("conexao_db.php");

if (isset($_GET['id'])){
    
    $id_evento = $_GET['id'];
    
    $consulta = $db_con->prepare("INSERT INTO usuario_evento (fk_usuario_id, fk_evento_id) values (, $id_evento)");

	if ($consulta->execute()) {
    }
}




?>