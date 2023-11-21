<?php
$resposta = array();
function criar_endereco($db_con, $cep, $bairro, $cidade, $estado, $descricao, $numero, $complemento){
    $cep = trim($cep);
    $numero = trim($numero);
    $consulta_endereco = $db_con->prepare("SELECT * FROM endereco WHERE cep = '$cep' and numero = '$numero'");
    $consulta_endereco->execute();
    if($consulta_endereco->rowCount() == 0){
            
        $bairro = trim($bairro);
        $cidade = trim($cidade); 
        $descricao = trim($descricao);
        $complemento = trim($complemento);
        
        $consulta_estado = $db_con->prepare("SELECT id FROM estado WHERE id = '$estado'");
        $consulta_estado->execute();
        $linha_estado = $consulta_estado->fetch(PDO::FETCH_ASSOC);

        $consulta_cidade = $db_con->prepare("SELECT * FROM cidade WHERE nome = '$cidade'");
        $consulta_cidade->execute();
        if($consulta_cidade->rowCount() == 0){
            $id_estado = $linha_estado["id"];
            $consulta_criar_cidade = $db_con->prepare("INSERT INTO cidade(nome, FK_ESTADO_id) VALUES('$cidade', '$id_estado')");
            if ($consulta_criar_cidade->execute()) {
                // se a consulta deu certo, indicamos sucesso na operação.
                $resposta["sucesso"] = 1;
            }
            else {
                // se houve erro na consulta, indicamos que não houve sucesso
                // na operação e o motivo no campo de erro.
                $resposta["sucesso"] = 0;
                $resposta["erro"] = "erro BD: " . $consulta_criar_cidade->error;
            }
            $consulta_cidade = $db_con->prepare("SELECT id FROM cidade WHERE nome = '$cidade'");
            $consulta_cidade->execute();
        }
        $linha_cidade = $consulta_cidade->fetch(PDO::FETCH_ASSOC);

        $consulta_bairro = $db_con->prepare("SELECT * FROM bairro WHERE nome = '$bairro'");
        $consulta_bairro->execute();
        if($consulta_bairro->rowCount() == 0){
            $id_cidade = $linha_cidade["id"];
            $consulta_criar_bairro = $db_con->prepare("INSERT INTO bairro(nome, FK_CIDADE_id) VALUES('$bairro', '$id_cidade')");
            if ($consulta_criar_bairro->execute()) {
                // se a consulta deu certo, indicamos sucesso na operação.
                $resposta["sucesso"] = 1;
            }
            else {
                // se houve erro na consulta, indicamos que não houve sucesso
                // na operação e o motivo no campo de erro.
                $resposta["sucesso"] = 0;
                $resposta["erro"] = "erro BD: " . $consulta_criar_bairro->error;
            }
            $consulta_bairro = $db_con->prepare("SELECT id FROM bairro WHERE nome = '$bairro'");
            $consulta_bairro->execute();
        }
        $linha_bairro = $consulta_bairro->fetch(PDO::FETCH_ASSOC);

        $id_bairro = $linha_bairro["id"];
        if ($complemento){
            $descricao =  $descricao . ", " . $complemento;
        }
        $consulta_criar_endereco = $db_con->prepare("INSERT INTO endereco(numero, cep, descricao, FK_BAIRRO_id) VALUES('$numero', '$cep', '$descricao', '$id_bairro') returning id");
        if ($consulta_criar_endereco->execute()) {
            // se a consulta deu certo, indicamos sucesso na operação.
            $resposta["sucesso"] = 1;
        }
        else {
            // se houve erro na consulta, indicamos que não houve sucesso
            // na operação e o motivo no campo de erro.
            $resposta["sucesso"] = 0;
            $resposta["erro"] = "erro BD: " . $consulta_criar_endereco->error;
        }
    }
    $linha_endereco = $consulta_criar_endereco->fetch(PDO::FETCH_ASSOC);
    $resposta["sucesso"] = 1;
    $resposta["id"] = $linha_endereco["id"];
    return $resposta["id"];
}
?>