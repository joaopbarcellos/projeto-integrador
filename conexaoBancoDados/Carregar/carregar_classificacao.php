<?php

function carregar_classificacao($db_con, $classificacao_id){
    $consulta_classificacao = $db_con->prepare("SELECT nome FROM classificacao WHERE id = " . $classificacao_id);
    $consulta_classificacao->execute();
    $linha_classificacao = $consulta_classificacao->fetch(PDO::FETCH_ASSOC);

    return $linha_classificacao["nome"];

}


?>