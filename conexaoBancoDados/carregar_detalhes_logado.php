<?php

require_once('conexao_db.php');
require_once('autenticacao.php');

// array de resposta
$resposta = array();

if (isset($_SESSION["logado"])){
    $email = $_SESSION["logado"];
    $consulta = $db_con->prepare("SELECT * FROM usuario WHERE email='$email'");
    $consulta->execute();   
    if ($consulta->rowCount() > 0) {
        $linha = $consulta->fetch(PDO::FETCH_ASSOC);

        $intuito_id = $linha["fk_intuito_id"];

        $consulta2 = $db_con->prepare("SELECT * FROM intuito WHERE id = $intuito_id");
        $consulta2->execute();
        $linha2 = $consulta2->fetch(PDO::FETCH_ASSOC);

        $_SESSION["logado_nome"] = $linha["nome"];
        $_SESSION["logado_data"] = $linha["data_nascimento"];
        $_SESSION["logado_telefone"] = $linha["telefone"];
        $_SESSION["logado_intuito"] = $linha2["nome"];
        $_SESSION["logado_foto"] = $linha["foto"];
    }
    
}
// Fecha a conexao com o BD
$db_con = null;
?>