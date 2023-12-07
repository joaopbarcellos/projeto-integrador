<?php
// esse arquivo CONSULTA se o usuario
// logado criou o evento que a pagina carregou

function criador($id, $db_con){
    if (isset($_SESSION["logado"])){
	    $email = $_SESSION["logado"];
	
	    $consultaEmail = $db_con->prepare("SELECT * FROM usuario WHERE email='$email'");
	    $consultaEmail->execute();
	    $linha = $consultaEmail->fetch(PDO::FETCH_ASSOC);
	    $id_logado = $linha['id'];
	
	    $consulta = $db_con->prepare("SELECT * FROM evento WHERE evento.id=$id AND evento.fk_usuario_id=$id_logado");
	    if($consulta->execute()){
		    $linha = $consulta->fetch(PDO::FETCH_ASSOC);
		    if ($linha){
			    return true;
		    }
		    return false;
	    }
    } else {
	    return false;
    }
}
?>
