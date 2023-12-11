<?php
function pegarClassificacao($db_con, $classificacao){
  $consulta_classificacao = $db_con->prepare("SELECT nome FROM classificacao WHERE id = " . $classificacao);
  $consulta_classificacao->execute();
  $linha_classificacao = $consulta_classificacao->fetch(PDO::FETCH_ASSOC);
  return $linha_classificacao["nome"];
}

?>
