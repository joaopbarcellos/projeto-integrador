<?php

function carregar_intervalo($db_con, $intervalo_id){
    $consulta_idade_publico = $db_con->prepare("SELECT intervalo FROM idade_publico WHERE id = " . $intervalo_id);
    $consulta_idade_publico->execute();
    $linha_idade_publico = $consulta_idade_publico->fetch(PDO::FETCH_ASSOC);
    return $linha_idade_publico["intervalo"];
}


?>