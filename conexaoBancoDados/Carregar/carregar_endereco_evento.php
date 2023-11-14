<?php
function carregar_endereco($db_con, $id_endereco){
    $consulta_endereco = $db_con->prepare("SELECT * FROM endereco WHERE id = " . $id_endereco);
    $consulta_endereco->execute();
    $linha_endereco = $consulta_endereco->fetch(PDO::FETCH_ASSOC);

    $consulta_bairro = $db_con->prepare("SELECT * FROM bairro WHERE id = " . $linha_endereco["fk_bairro_id"]);
    $consulta_bairro->execute();
    $linha_bairro = $consulta_bairro->fetch(PDO::FETCH_ASSOC);

    $consulta_cidade = $db_con->prepare("SELECT * FROM cidade WHERE id = " . $linha_bairro["fk_cidade_id"]);
    $consulta_cidade->execute();
    $linha_cidade = $consulta_cidade->fetch(PDO::FETCH_ASSOC);

    $consulta_estado = $db_con->prepare("SELECT nome FROM estado WHERE id = " . $linha_cidade["fk_estado_id"]);
    $consulta_estado->execute();
    $linha_estado = $consulta_estado->fetch(PDO::FETCH_ASSOC);
    
    return $linha_endereco["descricao"] . ", " . $linha_endereco["numero"] . " - " . $linha_bairro["nome"] . ", " . $linha_cidade["nome"] . " - " . $linha_estado["nome"] . ", " . $linha_endereco["cep"];
}

?>
