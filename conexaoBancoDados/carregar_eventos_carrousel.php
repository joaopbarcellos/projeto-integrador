<?php
require_once("conexao_db.php");
$resposta = array();
$resposta["eventos"] = array();
$limit = 5;
$consulta_mais_inscritos = $db_con->prepare(
    "SELECT evento.id, evento.max_pessoas FROM evento ORDER BY evento.max_pessoas LIMIT " . $limit);
if($consulta_mais_inscritos->execute()) {
    if ($consulta_mais_inscritos->rowCount() > 0) {
        while ($linha_mais_inscritos = $consulta_mais_inscritos->fetch(PDO::FETCH_ASSOC)) {
            $id_evento = $linha_mais_inscritos["id"];
            
            $consulta = $db_con->prepare("SELECT * from evento WHERE evento.id = $id_evento");
            $consulta->execute();
            $linha = $consulta->fetch(PDO::FETCH_ASSOC);

            // Array para cada evento
            $evento = array();
			
            // Informacoes pro carrousel
            $evento["id"] = $linha["id"];
            $evento["nome"] = $linha["nome"];
            $evento["foto"] = $linha["foto"];

            // Adiciona o evento no array de eventos.
            array_push($resposta["eventos"], $evento);
        }
    }
}   

// Converte a resposta para o formato JSON.
return json_encode($resposta);
?>