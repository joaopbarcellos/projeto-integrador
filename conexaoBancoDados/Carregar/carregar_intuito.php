<?php
// esse arquivo CONSULTA o intuito que esta no banco de dados

function carregar_intuito($db_con, $id_intuito){
    $consulta_intuito = $db_con->prepare("SELECT nome FROM intuito WHERE id = " . $id_intuito);
    $consulta_intuito->execute();
    $linha_intuito = $consulta_intuito->fetch(PDO::FETCH_ASSOC);
    return $linha_intuito["nome"];
}

?>