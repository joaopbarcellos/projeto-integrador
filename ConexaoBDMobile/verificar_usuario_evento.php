<?php
/* 
Esse arquivo é para verificar se o usuário é dono do evento ou se ele está inscrito
*/

require_once("conexao_db.php");

$resposta = array();


if(isset($_GET["email"])){
    $email = $_GET["email"];
    $id_evento = $_GET["id_evento"];

    $consulta_usuario = $db_con->prepare("SELECT * FROM usuario where email = '$email'");
    $consulta_usuario->execute();
    $id_usuario = $consulta_usuario->fetch(PDO::FETCH_ASSOC)["id"];

    $consulta_criador = $db_con->prepare("SELECT * FROM evento where fk_usuario_id = '$id_usuario' and id = '$id_evento'");
    $consulta_criador->execute();
    if($consulta_criador->rowCount() > 0){
        $resposta["usuario"] = "criador";
    }else{
        $consulta_inscrito = $db_con->prepare("SELECT * FROM usuario_evento where fk_usuario_id = '$id_usuario' and fk_evento_id = '$id_evento'");
        $consulta_inscrito->execute();
        if($consulta_inscrito->rowCount() > 0){
            $resposta["usuario"] = "inscrito";
        }else{
            $resposta["usuario"] = "nenhum";
        }
    }
}else{
    $resposta["usuario"] = "nenhum";
}

$db_con = null;
echo json_encode($resposta);
?>