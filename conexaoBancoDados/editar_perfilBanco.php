<?php
// conexão com bd
require_once('conexao_db.php');

// autenticação
require_once('autenticacao.php');
$resposta = array();

var_dump($_FILES);
var_dump($_POST);
if (isset($_POST["emailCampo"]) && isset($_POST["nomeCampo"]) && isset($_FILES["foto"]) && isset($_POST["telefoneCampo"]) && isset($_POST["dataCampo"]) && isset($_POST["jogabilidade"])){
    $email = trim($_POST["emailCampo"]);
    $nome = trim($_POST["nomeCampo"]);
    $telefone = filter_var(trim($_POST["telefoneCampo"]), FILTER_SANITIZE_NUMBER_INT);
    $data_nascimento = trim($_POST["dataCampo"]);
    $intuito = trim($_POST["jogabilidade"]);

    $filename = $_FILES['foto']['name'];
    $client_id="ce5d3a656e2aa51";
    $handle = fopen($filename, "r");
    $data = fread($handle, filesize($filename));
    $pvars   = array('image' => base64_encode($data));
    $timeout = 30;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
    curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
    $out = curl_exec($curl);
    curl_close ($curl);
    $pms = json_decode($out,true);
    $foto=$pms['data']['link'];

    echo $foto;
    echo $telefone;
    
    $consulta = $db_con->prepare("UPDATE usuario set nome='$nome', telefone='$telefone', data_nascimento='$data_nascimento', fk_intuito_id='$intuito', foto='$foto' WHERE email='$email'");
    $resposta["sucesso"] = 1;
    $consulta->execute();
}else{
    $resposta["sucesso"] = 0;
    $resposta["erro"] = "Faltam parâmetros";
}
$db_con = null;

// envia pra outra pagina
//header("location: ../perfil.php");
?>