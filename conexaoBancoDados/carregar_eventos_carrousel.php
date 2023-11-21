<?php
require_once("conexao_db.php");
$resposta = array();
$resposta["eventos"] = array();
$limit = 5;
$consulta_mais_inscritos = $db_con->prepare("SELECT * FROM (SELECT e.*, (COUNT(ue.fk_evento_id) * 100 / e.max_pessoas) AS porcentagem FROM evento e LEFT JOIN usuario_evento ue ON ue.fk_evento_id = e.id GROUP BY e.id, e.max_pessoas) AS subquery WHERE porcentagem < 100 ORDER BY max_pessoas DESC LIMIT " . $limit);
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