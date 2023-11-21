<?php
require_once('conexao_db.php');
require_once('Carregar/carregar_endereco_evento.php');

require_once('Carregar/carregar_intuito.php');
require_once('Carregar/carregar_classificacao.php');

require_once('Carregar/carregar_intervalo.php');
// array for JSON resposta
$resposta = array();
$resposta["eventos"] = array();
$email = $_SESSION["logado"];

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
        $evento["idade_publico"] = carregar_intervalo($db_con, $linha["fk_idade_publico_id"]);
        $evento["classificacao"] = carregar_classificacao($db_con, $linha["fk_classificacao_id"]);
        $evento["nome"] = $linha["nome"];
        $evento["preco"] = number_format($linha["preco"], 2, ',', '');
        $evento["data"] = $linha["data"];
        $evento["horario_fim"] = $linha["horario_fim"];
        $evento["horario_inicio"] = $linha["horario_inicio"];
        $evento["intuito"] = carregar_intuito($db_con, $linha["fk_intuito_id"]);
        $evento["endereco"] = carregar_endereco($db_con, $linha["fk_endereco_id"]);
        $evento["foto"] = $linha["foto"];
        // Adiciona o evento no array de eventos.
        array_push($resposta["eventos"], $evento);
        
    }
}
return json_encode($resposta);
$db_con = null;
?>