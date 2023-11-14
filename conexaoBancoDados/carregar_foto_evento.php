<?php

function carregar_foto($db_con, $id_){
    $consulta_foto_evento = $db_con->prepare("SELECT foto FROM foto_evento WHERE fk_evento_id = " . $evento["id"]);
    $consulta_foto_evento->execute();
    $linha_foto_evento = $consulta_foto_evento->fetch(PDO::FETCH_ASSOC);
    $evento["foto"] = $linha_foto_evento["foto"];
}

?>