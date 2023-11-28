<?php
// esse arquivo CONSULTA os eventos que
// o usuario logado esta inscrito

require_once('conexao_db.php')
// array for JSON resposta
$resposta = array();
$resposta["eventos"] = array();
$email = $_GET["email"];

$consultaEmail = $db_con->prepare("SELECT * FROM usuario WHERE email='$email'");
$consultaEmail->execute();
$linhaUsuario = $consultaEmail->fetch(PDO::FETCH_ASSOC);
$id_logado = intval($linhaUsuario['id']);

$consulta = $db_con->prepare("SELECT * FROM usuario_evento WHERE fk_usuario_id =$id_logado");
$consulta->execute();
if ($consulta->rowCount() > 0) {
    while($linha_tabela = $consulta->fetch(PDO::FETCH_ASSOC)){
        $evento = array();
        $evento["id"] = $linha_tabela['fk_evento_id'];
        

        $consulta_evento = $db_con->prepare("SELECT * FROM evento where id = '" . $evento["id"] . "'");
        $consulta_evento->execute();
        $linha = $consulta_evento->fetch(PDO::FETCH_ASSOC);
        $evento["id"] = $linha["id"];
        $evento["nome"] = $linha["nome"];
        $evento["preco"] = number_format($linha["preco"], 2, ',', '');
        $evento["data"] = $linha["data"];
        $evento["horario_fim"] = $linha["horario_fim"];
        $evento["horario_inicio"] = $linha["horario_inicio"];
        $evento["foto"] = $linha["foto"];
        // Adiciona o evento no array de eventos.
        array_push($resposta["eventos"], $evento);
        
    }
}
return json_encode($resposta);
$db_con = null;
?>