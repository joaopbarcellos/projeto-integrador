<?php
// esse arquivo CRIA um evento no banco de dados

// conexão com bd
require_once('conexao_db.php');

// endereco evento
require_once('criar_endereco_evento.php');

// usuario que criou evento
require_once('carregar_usuario_evento.php');

// array de resposta
$resposta = array();

ini_set('display_errors', 1);

if (isset($_POST['nome']) && isset($_POST['preco']) && isset($_POST['descricao']) && isset($_POST['data']) && isset($_POST['min_pessoas']) 
&& isset($_POST['horario_inicio']) && isset($_POST['max_pessoas']) && isset($_POST['intuito']) && isset($_POST['cepEvento']) 
&& isset($_POST['cidadeEvento']) && isset($_POST['estadoEvento']) && isset($_POST['logradouroEvento']) && isset($_POST['bairroEvento']) 
&& isset($_POST['numeroEvento']) && isset($_POST['complementoEvento']) && isset($_POST['idade_publico']) && isset($_POST['classificacao']) 
&& isset($_POST['horario_fim'])) {

	// Aqui sao obtidos os parametros
	$nome = trim($_POST['nome']);
	$preco = trim($_POST['preco']);
	$descricao = trim($_POST['descricao']);
	$data = trim($_POST['data']);
	$min_pessoas = trim($_POST['min_pessoas']);
	$horario_inicio = trim($_POST['horario_inicio']);
	$horario_fim = trim($_POST['horario_fim']);
	$max_pessoas = trim($_POST['max_pessoas']);
	$intuito = trim($_POST['intuito']);
	$classificacao = trim($_POST['classificacao']);
	$idade_publico = trim($_POST['idade_publico']);

	

	// Chamar funcao para criar o endereço
	$cep_evento = trim($_POST['cepEvento']);
	$bairro_evento = trim($_POST['bairroEvento']);
	$cidade_evento = trim($_POST['cidadeEvento']);
	$estado_evento = trim($_POST['estadoEvento']);
	$descricao_evento = trim($_POST['logradouroEvento']);
	$numero_evento = trim($_POST['numeroEvento']);
	$complemento_evento = trim($_POST['complementoEvento']);
	
	$endereco = criar_endereco($db_con, $cep_evento, $bairro_evento, $cidade_evento, $estado_evento, $descricao_evento, $numero_evento, $complemento_evento);
	
	// Chamar funcao para pegar o id do usuario
	$usuario = carregar_usuario($db_con);
	if ($_FILES["foto_evento"]["size"] > 0){
		$foto = NULL;
		$client_id = "6d2b5be8400b2b3";
		$filename = $_FILES['foto_evento']['tmp_name'];
	
		$image_data = file_get_contents($filename);
		$image_data_base64 = base64_encode($image_data);
	
		$api_url = 'https://api.imgur.com/3/image.json';
	
		$headers = [
			'Authorization: Client-ID ' . $client_id
		];
	
		$postData = [
			'image' => $image_data_base64
		];
	
		$options = [
			'http' => [
				'header' => implode("\r\n", $headers),
				'method' => 'POST',
				'content' => http_build_query($postData)
			]
		];
	
		$context = stream_context_create($options);
		$result = file_get_contents($api_url, false, $context);
	
		if ($result === FALSE) {
			echo "Erro ao enviar arquivo para o Imgur";
		} else {
			$response = json_decode($result, true);
			$foto = $response['data']['link'];
		}

		if ($foto == NULL){
			$consulta = $db_con->prepare("INSERT INTO EVENTO(descricao, nome, foto, data, min_pessoas, horario_inicio, horario_fim, max_pessoas, FK_CLASSIFICACAO_id, FK_INTUITO_id, FK_ENDERECO_id, FK_USUARIO_id, FK_IDADE_PUBLICO_id, preco) VALUES('$descricao', '$nome', 'https://i.imgur.com/ebF3p8e.png', '$data', $min_pessoas, '$horario_inicio', '$horario_fim', $max_pessoas, $classificacao, $intuito, $endereco, $usuario, $idade_publico, $preco) returning id");
		if ($consulta->execute()) {
			$resposta["sucesso"] = 1;
		} else {
			$resposta["sucesso"] = 0;
			$resposta["erro"] = "Erro ao criar produto no BD: " . $consulta->$error;
		}
		} else {
			$consulta = $db_con->prepare("INSERT INTO EVENTO(descricao, nome, foto, data, min_pessoas, horario_inicio, horario_fim, max_pessoas, FK_CLASSIFICACAO_id, FK_INTUITO_id, FK_ENDERECO_id, FK_USUARIO_id, FK_IDADE_PUBLICO_id, preco) VALUES('$descricao', '$nome', '$foto', '$data', $min_pessoas, '$horario_inicio', '$horario_fim', $max_pessoas, $classificacao, $intuito, $endereco, $usuario, $idade_publico, $preco) returning id");
			if ($consulta->execute()) {
				$resposta["sucesso"] = 1;
			} else {
				$resposta["sucesso"] = 0;
				$resposta["erro"] = "Erro ao criar produto no BD: " . $consulta->$error;
			}
		}
	} else {
		$consulta = $db_con->prepare("INSERT INTO EVENTO(descricao, nome, foto, data, min_pessoas, horario_inicio, horario_fim, max_pessoas, FK_CLASSIFICACAO_id, FK_INTUITO_id, FK_ENDERECO_id, FK_USUARIO_id, FK_IDADE_PUBLICO_id, preco) VALUES('$descricao', '$nome', 'https://i.imgur.com/ebF3p8e.png', '$data', $min_pessoas, '$horario_inicio', '$horario_fim', $max_pessoas, $classificacao, $intuito, $endereco, $usuario, $idade_publico, $preco) returning id");
		if ($consulta->execute()) {
			$resposta["sucesso"] = 1;
		} else {
			$resposta["sucesso"] = 0;
			$resposta["erro"] = "Erro ao criar produto no BD: " . $consulta->$error;
		}
	}
} else {
	// Se a requisicao foi feita incorretamente, ou seja, os parametros 
	// nao foram enviados corretamente para o servidor, o cliente 
	// recebe a chave "sucesso" com valor 0. A chave "erro" indica o 
	// motivo da falha.
	$resposta["sucesso"] = 0;
	$resposta["erro"] = "Campo requerido nao preenchido";
}


$linha_id = $consulta->fetch(PDO::FETCH_ASSOC);
$id_evento = $linha_id["id"];

// Fecha a conexao com o BD
$db_con = null;

header("location: ../evento.php?id_evento=$id_evento");
?>
