<?php
require_once("conexao_db.php");

$resposta = array();
$resposta["eventos"] = array();

if(isset($_GET["limit"]) && isset($_GET["offset"])){
	
    $limit = $_GET["limit"];
    $offset = $_GET["offset"];
  
    $string_consulta = "SELECT * from evento where";
    if($_GET["preco"] != "0"){
      $array_precos = [" preco >= 0.00 and preco < 10.00", " preco >= 10.00 and preco < 20.00", " preco >= 20.00 and preco < 30.00", " preco >= 30.00 and preco < 50.00", " preco >= 50.00 and preco < 100.00",
        " preco >= 100.00 and preco < 200.00", " preco >= 200.00 and preco < 500.00", " preco >= 500.00 and preco < 1000.00", " preco >= 1000.00 and preco <= 5000.00"];
      $index = intval($_GET["preco"]);
      $string_consulta .= $array_precos[$index];
    }

    if($_GET["idade"] != "Nenhum"){
      $idade = $_GET["idade"];
      $consulta_idade = $db_con->prepare("SELECT * from idade_publico where intervalo = '$idade'");
      $consulta_idade->execute();
      $id_idade = $consulta_idade->fetch(PDO::FETCH_ASSOC)["id"];
      if($_GET["preco"] != "0"){
        $string_consulta .= " and fk_idade_publico_id = $id_idade";
      }else{
        $string_consulta .= " fk_idade_publico_id = $id_idade";
      }
    }

    if($_GET["intuito"] != "Nenhum"){
      $intuito = $_GET["intuito"];
      $consulta_intuito = $db_con->prepare("SELECT * from intuito where nome = '$intuito'");
      $consulta_intuito->execute();
      $id_intuito = $consulta_intuito->fetch(PDO::FETCH_ASSOC)["id"];
       if($_GET["preco"] != "0" || $_GET["idade"] != "Nenhum"){
        $string_consulta .= " and fk_intuito_id = $id_intuito";
      }else{
        $string_consulta .= " fk_intuito_id = $id_intuito";
      }
    }

    
    if($_GET["ordenar_preco"] != "Nenhum"){
      $ordenar_preco = $_GET["ordenar_preco"];
      if($ordenar_preco == "Do menor para o maior"){
        $string_consulta .= " order by preco";
      }else{
        $string_consulta .= " order by preco desc";
      }
    }

    $string_consulta .= " LIMIT $limit OFFSET $offset";

    $consulta = $db_con->prepare($string_consulta);
    if($consulta->execute()){
      if ($consulta->rowCount() > 0) {
  		  while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    			$evento = array();
    			
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
        $resposta["sucesso"] = 1;
	    }
    }else{
      $resposta["sucesso"] = 0;
	    $resposta["erro"] = "Erro no BD: " . $consulta->$error;
    }
    
}else{
  $resposta["sucesso"] = 0;
  $resposta["erro"] = "Campo requirido não preenchido";
}

$db_con = null;
echo json_encode($resposta);
?>
