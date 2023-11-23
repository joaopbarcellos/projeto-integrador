<?php
// esse arquivo CONSULTA se o usuario
// esta inscrito no evento que ele clicou

function inscrito($id_evento, $db_con){
    $email = $_SESSION["logado"];

    $consultaEmail = $db_con->prepare("SELECT * FROM usuario WHERE email='$email'");
    $consultaEmail->execute();
    $linha = $consultaEmail->fetch(PDO::FETCH_ASSOC);
    $id_logado = $linha['id'];

    $consulta = $db_con->prepare("SELECT * FROM usuario_evento WHERE fk_usuario_id = '$id_logado' AND fk_evento_id='$id_evento'");
	if($consulta->execute()){
        $linha = $consulta->fetch(PDO::FETCH_ASSOC);
        if ($linha){
            return true;
        }
        return false;
    }
}
?>