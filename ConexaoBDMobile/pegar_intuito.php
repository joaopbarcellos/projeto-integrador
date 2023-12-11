<?php
function pegarIntuito($db_con, $intuito){
  $consulta_intuito = $db_con->prepare("SELECT nome FROM intuito WHERE id = " . $intuito);
  $consulta_intuito->execute();
  $linha_intuito = $consulta_intuito->fetch(PDO::FETCH_ASSOC);
  return $linha_intuito["nome"];
}
?>
