<?php

require_once("conexao_db.php");
$resposta = array();
$resposta["eventos"] = array();
if(isset($_GET["pesquisa"]) && isset($_GET["limit"]) && isset($_GET["offset"])){
  $limit = $_GET["limit"];
  $offset = $_GET["offset"];
  $pesquisa = $_GET["pesquisa"];
  if($pesquisa == ""){
	  $consulta_pesquisa = $db_con->prepare("SELECT * FROM evento WHERE nome LIMIT '$limit' OFFSET '$offset'");
  }else{
	  $consulta_pesquisa = $db_con->prepare("SELECT * FROM evento WHERE nome ILIKE '%$pesquisa%' LIMIT '$limit' OFFSET '$offset'");
  }
  if($consulta_pesquisa->execute()){
      while($linha = $consulta_pesquisa->fetch(PDO::FETCH_ASSOC)){
        $evento = array();
        
        $evento["id"] = $linha["id"];
	$evento["foto"] = $linha["foto"];

	$evento["nome"] = $linha["nome"];
	$evento["preco"] = number_format($linha["preco"], 2, ',', '');
	$evento["data"] = $linha["data"];
	$evento["horario_fim"] = $linha["horario_fim"];
	$evento["horario_inicio"] = $linha["horario_inicio"];

	// Adiciona o evento no array de eventos.
	array_push($resposta["eventos"], $evento);
      }
      $resposta["sucesso"] = 1;
  }else {
      $resposta["sucesso"] = 0;
      $resposta["erro"] = "Erro no Banco de Dados = " . $consulta_pesquisa->$error;
  }
}else {
	// Se a requisicao foi feita incorretamente, ou seja, os parametros 
	// nao foram enviados corretamente para o servidor, o cliente 
	// recebe a chave "sucesso" com valor 0. A chave "erro" indica o 
	// motivo da falha.
	$resposta["sucesso"] = 0;
	$resposta["erro"] = "Campo requerido não preenchido";
}

$db_con = null;
echo json_encode($resposta);

?>
