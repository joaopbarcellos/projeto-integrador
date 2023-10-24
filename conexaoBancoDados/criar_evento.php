<?php

/*
 * O seguinte codigo abre uma conexao com o BD e adiciona um evento nele.
 * As informacoes de um evemto sao recebidas atraves de uma requisicao POST.
 */

// conexão com bd
require_once('conexao_db.php');

// autenticação
require_once('autenticacao.php');

// array de resposta
$resposta = array();

// verifica se o usuário conseguiu autenticar
if(autenticar($db_con)) {
	
	// Primeiro, verifica-se se todos os parametros foram enviados pelo cliente.
	// A criacao de um evento precisa dos seguintes parametros:
	// 	descricao
	//  nome
	//  foto
	//  data
	//  telefone
	//  min_pessoas 
	//  preco
	//  horario_inicio
	//  max_pessoas
	//  FK_INTUITO_id
	//  FK_ENDERECO_id
	//  FK_USUARIO_id
	//  FK_IDADE_PUBLICO_id

	if (isset($_POST['nome']) && isset($_POST['preco']) && isset($_POST['descricao']) && isset($_FILES['foto']) && isset($_POST['data']) && isset($_POST['telefone']) && isset($_POST['min_pessoas']) 
	&& isset($_POST['horario_inicio']) && isset($_POST['max_pessoas']) && isset($_POST['intuito']) && isset($_POST['usuario']) && isset($_POST['endereco']) && isset($_POST['idade_publico'])) {

		// Aqui sao obtidos os parametros
		$nome = $_POST['nome'];
		$preco = $_POST['preco'];
		$descricao = $_POST['descricao'];
		$data = $_POST['data'];
		$telefone = $_POST['telefone'];
		$min_pessoas = $_POST['min_pessoas'];
		$horario_inicio = $_POST['horario_inicio'];
		$max_pessoas = $_POST['max_pessoas'];
		$intuito = $_POST['intuito'];
		$endereco = $_POST['endereco'];
		$usuario = $_POST['usuario'];
		$idade_publico = $_POST['idade_publico'];

		$filename = $_FILES['foto']['tmp_name'];
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
		$img_url=$pms['data']['link'];

		// A proxima linha insere um novo produto no BD.
		// A variavel consulta indica se a insercao foi feita corretamente ou nao.
		$consulta = $db_con->prepare("INSERT INTO EVENTO(descricao, nome, foto, data, telefone, min_pessoas, horario_inicio, max_pessoas, FK_INTUITO_id, FK_ENDERECO_id, FK_USUARIO_id, FK_IDADE_PUBLICO_id)
		VALUES('$descricao', '$nome', '$img_url', '$data', '$telefone', '$min_pessoas', '$horario_inicio', '$max_pessoas', '$intuito', '$endereco', '$usuario', '$idade_publico')");
		if ($consulta->execute()) {
			// Se o produto foi inserido corretamente no servidor, o cliente 
			// recebe a chave "sucesso" com valor 1
			$resposta["sucesso"] = 1;
		} else {
			// Se o produto nao foi inserido corretamente no servidor, o cliente 
			// recebe a chave "sucesso" com valor 0. A chave "erro" indica o 
			// motivo da falha.
			$resposta["sucesso"] = 0;
			$resposta["erro"] = "Erro ao criar produto no BD: " . $consulta->error;
		}
	} else {
		// Se a requisicao foi feita incorretamente, ou seja, os parametros 
		// nao foram enviados corretamente para o servidor, o cliente 
		// recebe a chave "sucesso" com valor 0. A chave "erro" indica o 
		// motivo da falha.
		$resposta["sucesso"] = 0;
		$resposta["erro"] = "Campo requerido nao preenchido";
	}
}
else {
	// senha ou usuario nao confere
	$resposta["sucesso"] = 0;
	$resposta["erro"] = "usuario ou senha não confere";
}

// Fecha a conexao com o BD
$db_con = null;

// Converte a resposta para o formato JSON.
echo json_encode($resposta);
?>